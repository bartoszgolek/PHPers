<?php

	namespace Conpago\TestApp\Business\Interactor;

	use Conpago\TestApp\Business\Contract\Interactor\IHelloWorld;
	use Conpago\TestApp\Business\Contract\Presenter\IHelloWorldPresenter;

	class HelloWorld implements IHelloWorld
	{
		/**
		 * @var IHelloWorldPresenter
		 */
		private $presenter;

		public function __construct(
			IHelloWorldPresenter $presenter
		)
		{
			$this->presenter = $presenter;
		}

		public function run()
		{
			$this->presenter->showHelloWorld();
		}
	}
