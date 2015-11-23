<?php

	namespace Conpago\Pizza\Business\Interactor;

	use Conpago\Pizza\Business\Contract\Interactor\IHelloWorld;
	use Conpago\Pizza\Business\Contract\Presenter\IHelloWorldPresenter;

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
