<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-05-21
	 * Time: 21:27
	 */

	namespace Conpago\TestApp\Presentation\Controller;

	use Conpago\Helpers\Contract\IRequestData;
	use Conpago\TestApp\Presentation\Contract\Controller\IHelloWorldController;
	use Conpago\TestApp\Business\Contract\Interactor\IHelloWorld;

	class HelloWorldController implements IHelloWorldController
	{

		/**
		 * @var IHelloWorld
		 */
		private $listUsers;

		function __construct(IHelloWorld $listUsers)
		{
			$this->listUsers = $listUsers;
		}

		/**
		 * @param IRequestData $data
		 *
		 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
		 */
		function execute(IRequestData $data)
		{
			$this->listUsers->run();
		}
	}