<?php

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;
	use Conpago\TestApp\CommonModule;
	use Conpago\TestApp\PackagesModule;

	class WebModule implements IModule
	{
		/**
		 * @param IContainerBuilder $builder
		 */
		public function build(IContainerBuilder $builder)
		{
			$common_module = new CommonModule();
			$common_module->build($builder);

			$packages_module = new PackagesModule();
			$packages_module->build($builder);
		}
	}