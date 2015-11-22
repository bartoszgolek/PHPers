<?php

	namespace Conpago\TestApp\Modules;

	use Conpago\DI\IContainer;
	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;
	use Conpago\Presentation\Contract\IControllerResolver;

	class ControllerModule implements IModule
	{
		public function build(IContainerBuilder $builder)
		{

			$builder
				->registerType('Conpago\Core\ControllerResolver')
				->asA('Conpago\IControllerResolver');

			$builder
				->register(function (IContainer $c)
				{
					/** @var IControllerResolver $controllerResolver */
					$controllerResolver = $c->resolve('Conpago\IControllerResolver');

					return $controllerResolver->getController();
				})
				->asA('Conpago\Presentation\Contract\IController');
		}
	}
