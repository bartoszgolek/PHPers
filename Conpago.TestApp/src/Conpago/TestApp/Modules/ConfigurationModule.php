<?php

namespace Conpago\TestApp\Modules;

use Conpago\Config\PhpConfig;
use Conpago\DI\IContainer;
use Conpago\DI\IContainerBuilder;
use Conpago\DI\IModule;
use Conpago\Helpers\Contract\IAppMask;

class ConfigurationModule implements IModule {
	public function build(IContainerBuilder $builder) {

		$builder->registerType('Conpago\Utils\SessionAccessor');
		$builder->registerType('Conpago\Utils\ServerAccessor');

		$builder
			->registerType('Conpago\Helpers\AppMask')
			->asA('Conpago\Helpers\Contract\IAppMask');

		$builder
			->registerType('Conpago\Core\WebApp')
			->asA('Conpago\Contract\IApp');

		$builder
			->register(function(IContainer $c)
			{
				/** @var IAppMask $appMask */
				$appMask = $c->resolve('Conpago\Helpers\Contract\IAppMask');
				return new PhpConfig(
					$c->resolve('Conpago\File\Contract\IFileSystem'),
					$appMask->configMask()
				);
			})
			->asA('Conpago\Config\Contract\IConfig')
			->singleInstance();

		$builder
			->registerType('Conpago\TestApp\AppConfig')
			->asA('Conpago\Config\Contract\IAppConfig');

		$builder
			->registerType('Conpago\TimeService')
			->asA('Conpago\Contract\ITimeService');

		$builder
			->registerType('Conpago\Helpers\Response')
			->asA('Conpago\Helpers\Contract\IResponse');

		$builder
			->registerType('Conpago\TestApp\LoggerConfigProvider')
			->asA('Conpago\Logging\Contract\ILoggerConfigProvider');

		$builder
			->registerType('Conpago\TestApp\LoggerConfig')
			->asA('Conpago\ILoggerConfig');

		$builder
			->registerType('Conpago\Logs\MonologLogger')
			->asA('Conpago\ILogger');
	}
}