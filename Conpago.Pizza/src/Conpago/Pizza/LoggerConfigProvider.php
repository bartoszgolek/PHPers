<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 07.10.15
	 * Time: 19:28
	 */

	namespace Conpago\Pizza;


	use Conpago\Config\ConfigBase;
	use Conpago\Config\Contract\IConfig;
	use Conpago\Helpers\Contract\IAppPath;
	use Conpago\Logging\Contract\ILoggerConfig;
	use Conpago\Logging\Contract\ILoggerConfigProvider;

	class LoggerConfigProvider extends ConfigBase implements ILoggerConfigProvider {

		/**
		 * @var IAppPath
		 */
		protected $appPath;

		function __construct(IConfig $config, IAppPath $appPath) {
			parent::__construct($config);
			$this->appPath = $appPath;
		}

		/**
		 * @return ILoggerConfig[]
		 */
		function getConfigs() {
			$result = [];
			foreach ($this->config->getValue('app.log') as $appLogConfig) {
				$result[] = new LoggerConfig(
						$appLogConfig['log_level'],
						implode(DIRECTORY_SEPARATOR, array($this->appPath->root(), $appLogConfig['log_file']))
				);
			}
			return $result;
		}
	}