<?php

	use Behat\Behat\Context\SnippetAcceptingContext;
	use Behat\Gherkin\Node\TableNode;
	use Conpago\DI\IContainer;
	use Conpago\DI\IModule;
	use Conpago\Helpers\Contract\IPasswordHasher;
	use Conpago\Helpers\Contract\IRequestData;
	use Conpago\Presentation\Contract\IController;
	use Saigon\TeamMate\Business\Contract\Model\IUser;
	use Saigon\TeamMate\Dao\Model\User;


	// Require 3rd-party libraries here:
	require_once "vendor/autoload.php";
	require_once "features/bootstrap/DoctrineHelper.php";
	require_once "features/bootstrap/AppHelper.php";
	require_once "vendor/phpunit/phpunit/src/Framework/Assert/Functions.php";

	/**
	 * Features context.
	 */
	class FeatureContext implements SnippetAcceptingContext
	{

		public static $entityManager;

		/**
		 * @var IContainer;
		 */
		private $container;

		/**
		 *
		 * @var DoctrineHelper
		 */
		private $doctrineHelper;

		/**
		 * @var IPasswordHasher
		 */
		private $passwordHasher;

		/**
		 * @var IUser[]
		 */
		protected $users;

		private function isUserExists($username)
		{
			$user = $this->getUser($username);
			$this->setUsers($username, $user);

			return $user != null;
		}

		private function countExistingUsers($username)
		{
			$user = $this->doctrineHelper->entityManager->getRepository($this->doctrineHelper->entityFullName('User'))
				->findOneBy(array('username' => $username));

			/** @var $user array */

			return count($user);
		}

		/**
		 * Initializes context.
		 * Every scenario gets its own context object.
		 */
		public function __construct()
		{
			$this->doctrineHelper = new DoctrineHelper();
			$appHelper = new AppHelper();
			$appHelper->initApp();

			$appBuilderFactory = new TestAppBuilderFactory();
			$appBuilder = $appBuilderFactory->createAppBuilder("Web", ".");
			$appBuilder->buildApp();
			$this->container = $appBuilder->getContainer();

			$this->passwordHasher = $this->container->resolve('Conpago\Helpers\Contract\IPasswordHasher');

			$this->jar = new CookieJar();
			$this->client = new Client();
		}

		/**
		 * @BeforeScenario
		 */
		public function createSchema()
		{
			$this->doctrineHelper->createSchema();
		}

		/**
		 * @AfterScenario
		 */
		public function dropSchema()
		{
			$this->doctrineHelper->dropSchema();
		}

		/**
		 * @param string $interactorName
		 * @param IRequestData $data
		 */
		public function runInteractor($interactorName, IRequestData $data)
		{
			/** @var \Conpago\DI\Lazy[] $controllers */
			$controllers = $this->container->resolveAll('Lazy<Conpago\\IController>');
			$controllerLazyInitializer = $controllers[$interactorName."Controller"];

			/** @var IController $controller */
			$controller = $controllerLazyInitializer->getInstance();
			$controller->execute($data);
		}

		private function servicePost($interactor, $data)
		{
			$headers = ['Content-Type' => 'application/json'];
			$body = json_encode($data);

			$request = new Request(
					'POST',
					$this->getServiceUrl() . '?interactor=' . $interactor,
					$headers,
					$body);
			try {
				$res = $this->client->send( $request, [ 'cookies' => $this->jar ] );

				$body         = (string) $res->getBody();
				echo "Result body: ".$body;
				$this->result = json_decode( $body, true );
			}
			catch (ClientException $caught)
			{
				$res = $caught->getResponse();
				$body         = (string) $res->getBody();
				echo "Error body: ".$body;
				$this->result = json_decode( $body, true );
			}
		}

		private function serviceGet($interactor)
		{
			$headers = [
					'Content-Type' => 'application/json'
			];
			$request = new Request(
					'GET',
					$this->getServiceUrl() . '?interactor=' . $interactor,
					$headers);
			try {
				$res = $this->client->send($request, ['cookies' => $this->jar]);

				$body = $res->getBody();
				echo "Result body: ".$body;
				$this->result = json_decode($body, true);
			}
			catch (ClientException $caught)
			{
				$res = $caught->getResponse();
				$body = (string) $res->getBody();
				echo "Error body: ".$body;
				$this->result = json_decode( $body, true );
			}
		}

		function getServiceUrl()
		{
			$serviceUrl = getenv ('TEAMMATE_SERVER_URL');
			if ($serviceUrl === false)
				return 'http://localhost:81/TeamMate.Server/public/index.php';

			return $serviceUrl;
		}
	}

	class TestModule implements IModule
	{
		public function build(\Conpago\DI\IContainerBuilder $builder)
		{
			$builder
				->registerInstance(FeatureContext::$entityManager)
				->asA('Doctrine\ORM\EntityManagerInterface');
		}
	}
