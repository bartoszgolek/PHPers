<?php

	namespace Conpago\TestApp\Modules;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;

	class PresenterModule implements IModule
	{
		public function build(IContainerBuilder $builder)
		{
			$builder
				->registerType('Conpago\Presentation\PlainPresenter')
				->asA('Conpago\Presentation\Contract\IPlainPresenter')
				->singleInstance();
		}
	}