<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Conpago\TestApp\Business\Modules;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\Parameter;
	use Conpago\DI\IModule;

	class HelloWorldModule implements IModule
	{

		/**
		 * @param IContainerBuilder $builder
		 *
		 * @SuppressWarnings(PHPMD.StaticAccess)
		 */
		public function build(IContainerBuilder $builder)
		{
			$builder->registerType('Conpago\TestApp\Presentation\Controller\HelloWorldController')
				->asA('Conpago\IController')
				->asA('Conpago\TestApp\Presentation\Contract\Controller\IHelloWorldController')
				->keyed('HelloWorldController')
				->singleInstance();

			$builder->registerType('Conpago\TestApp\Business\Interactor\HelloWorld')
				->asA('Conpago\TestApp\Business\Contract\Interactor\IHelloWorld')
				->named('HelloWorld')
				->singleInstance();

			$builder->registerType('Conpago\TestApp\Presentation\Presenter\HelloWorldPresenter')
				->asA('Conpago\TestApp\Business\Contract\Presenter\IHelloWorldPresenter')
				->singleInstance();
		}
	}