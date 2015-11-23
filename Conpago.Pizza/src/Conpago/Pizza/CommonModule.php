<?php

	namespace Conpago\Pizza;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;
	use Conpago\Pizza\Modules\AppModulesModule;
	use Conpago\Pizza\Modules\ConfigurationModule;
	use Conpago\Pizza\Modules\ControllerModule;
	use Conpago\Pizza\Modules\PresenterModule;
	use Conpago\Pizza\Modules\RequestModule;

	class CommonModule implements IModule
	{
		public function build(IContainerBuilder $builder)
		{
			$this->buildConfigurationModule($builder);
			$this->buildPresenterModule($builder);
			$this->buildRequestModule($builder);
			$this->buildAppModulesModule($builder);
			$this->buildControllerModuleModule($builder);
		}

		/**
		 * @param IContainerBuilder $builder
		 */
		protected function buildConfigurationModule(IContainerBuilder $builder)
		{
			$module = new ConfigurationModule();
			$module->build($builder);
		}

		/**
		 * @param IContainerBuilder $builder
		 */
		protected function buildPresenterModule(IContainerBuilder $builder)
		{
			$module = new PresenterModule();
			$module->build($builder);
		}

		/**
		 * @param IContainerBuilder $builder
		 */
		protected function buildRequestModule(IContainerBuilder $builder)
		{
			$module = new RequestModule();
			$module->build($builder);
		}

		/**
		 * @param IContainerBuilder $builder
		 */
		protected function buildAppModulesModule(IContainerBuilder $builder)
		{
			$module = new AppModulesModule();
			$module->build($builder);
		}

		private function buildControllerModuleModule( $builder ) {
			$module = new ControllerModule();
			$module->build($builder);
		}
	}