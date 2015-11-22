<?php

	namespace Conpago\TestApp\Modules;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;

	class RequestModule implements IModule
	{
		public function build(IContainerBuilder $builder)
		{
			$builder
				->registerType('Conpago\Helpers\Request')
				->asA('Conpago\Helpers\Contract\IRequest');

			$builder
				->registerType('Conpago\Helpers\RequestParser')
				->asA('Conpago\Helpers\Contract\IRequestParser');

			$builder
				->registerType('Conpago\Core\RequestDataReader')
				->asA('Conpago\Helpers\Contract\IRequestDataReader')
				->singleInstance();
		}
	}