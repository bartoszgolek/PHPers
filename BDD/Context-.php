<?php

	use \Behat\Behat\Context\SnippetAcceptingContext;
	use Behat\Gherkin\Node\TableNode;
	use Doctrine\ORM\Tools\SchemaTool;
	use Conpago\Auth\Contract\ISessionManager;
	use Conpago\Auth\Session;
	use Conpago\Auth\SessionManager;
	use Conpago\DI\IContainer;
	use Conpago\DI\IModule;
	use Conpago\Helpers\Contract\IPasswordHasher;
	use Conpago\Helpers\Contract\IRequestData;
	use Conpago\Presentation\Contract\IController;
	use Conpago\Utils\SessionAccessor;
	use Saigon\TeamMate\Business\Contract\Model\IUser;
	use Saigon\TeamMate\Dao\Model\User;

	use Conpago\Core\RequestData;

	// Require 3rd-party libraries here:
	require_once "vendor/autoload.php";
	require_once "features/bootstrap/DoctrineHelper.php";
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
		 * @var ISessionManager
		 */
		private $sessionManager;

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
			self::$entityManager = $this->doctrineHelper->entityManager;

			$classes = $this->doctrineHelper->entityManager->getMetadataFactory()->getAllMetadata();

			$schemaTool = new SchemaTool($this->doctrineHelper->entityManager);
			$schemaTool->dropSchema($classes);
			$schemaTool->createSchema($classes);

			$appBuilderFactory = new Conpago\AppBuilderFactory();
			$appBuilder = $appBuilderFactory->createAppBuilder("Web", ".");
			$appBuilder->registerAdditionalModule(new TestModule());
			$appBuilder->buildApp();
			$this->container = $appBuilder->getContainer();

			$this->passwordHasher = $this->container->resolve('Conpago\Helpers\Contract\IPasswordHasher');

			$this->presenter = $this->container->resolve('Conpago\Presentation\Contract\IJsonPresenter');
		}

		/**
		 * @BeforeScenario
		 */
		public function prepare()
		{
			$this->doctrineHelper->entityManager->getConnection()->beginTransaction();
		}

		/**
		 * @AfterScenario
		 */
		public function cleanDB()
		{
			$this->doctrineHelper->entityManager->getConnection()->rollBack();
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
	}
