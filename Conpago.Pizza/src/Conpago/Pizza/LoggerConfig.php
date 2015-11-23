<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 27.11.13
	 * Time: 19:27
	 */

	namespace Conpago\Pizza;


	use Conpago\Logging\Contract\ILoggerConfig;

	class LoggerConfig implements ILoggerConfig
	{
		/**
		 * @var
		 */
		private $log_level;
		/**
		 * @var
		 */
		private $log_file;

		/**
		 * @param $log_level
		 * @param $log_file
		 */
		function __construct($log_level, $log_file)
		{
			$this->log_level = $log_level;
			$this->log_file = $log_file;
		}

		function getLogLevel()
		{
			return $this->log_level;
		}

		function getLogFilePath()
		{
			return $this->log_file;
		}
	}