<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 09.11.13
	 * Time: 21:29
	 */

	namespace Conpago\Pizza;

	use Conpago\Config\ConfigBase;
	use Conpago\Config\Contract\IAppConfig;

	class AppConfig extends ConfigBase implements IAppConfig
	{
		function getDefaultInteractor()
		{
			return $this->config->getValue('app.default_interactor');
		}

		function getTimeZone() {
			return $this->config->getValue('app.timezone');
		}
	}