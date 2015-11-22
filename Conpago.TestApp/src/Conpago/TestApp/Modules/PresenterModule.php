<?php

	namespace Conpago\TestApp\Modules;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;

	class PresenterModule implements IModule
	{
		public function build(IContainerBuilder $builder)
		{
			$builder->registerType('Conpago\Presentation\JsonPresenter')
				->asA('Conpago\IPresenter')
				->keyed('JsonPresenter');
		}
	}