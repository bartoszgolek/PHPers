<?php

	namespace Conpago\TestApp;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;
	use Conpago\Logging\Monolog\MonologLoggerModule;

	class PackagesModule implements IModule
	{
		public function build(IContainerBuilder $builder)
		{
			$this->buildMonologLoggerModule($builder);
		}

		/**
		 * @param IContainerBuilder $builder
		 */
		protected function buildMonologLoggerModule(IContainerBuilder $builder)
		{
			$module = new MonologLoggerModule();
			$module->build($builder);
		}
	}