<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 29.10.13
	 * Time: 08:37
	 */

	namespace Conpago\TestApp\Modules;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;
	use Conpago\TestApp\Business\Modules\HelloWorldModule;

	class AppModulesModule implements IModule
	{

		public function build(IContainerBuilder $builder)
		{
			$helloWorldModule = new HelloWorldModule();
			$helloWorldModule->build($builder);
		}
	}