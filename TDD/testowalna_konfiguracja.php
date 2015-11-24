<?php
  $config = [
    'app' => [
			'default_interactor' => 'ListUsers',
			'log' => [
				[
					'log_level' => \Conpago\Logging\Contract\LogLevels::DEBUG,
					'log_file' => 'tmp' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'debug.log'
				],
				[
					'log_level' => \Conpago\Logging\Contract\LogLevels::INFO,
					'log_file' => 'tmp' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'application.log'
				],
				[
					'log_level' => \Conpago\Logging\Contract\LogLevels::ERROR,
					'log_file' => 'tmp' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'error.log'
				]
			],
			'timezone' => 'Europe/Warsaw'
		]
  ];

  interface ILoggerConfig
  {
    function getLogLevel();

    function getLogFilePath();
  }

  class LoggerConfig implements ILoggerConfig
	{
		private $log_level;
		private $log_file;

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

  interface ILoggerConfigProvider {
    /**
     * @return ILoggerConfig[]
     */
   function getConfigs();
  }

  class LoggerConfigProvider implements ILoggerConfigProvider {
    function __construct(array $config) {
      $this->config = $config
    }

    /**
     * @return ILoggerConfig[]
     */
    function getConfigs() {
      $result = [];
      foreach ($this->config['app']['log'] as $appLogConfig) {
        $result[] = new LoggerConfig(
            $appLogConfig['log_level'],
            $appLogConfig['log_file']
        );
      }
      return $result;
    }
  }

  class LoggerFactory
	{
		/**
		 * @var ILoggerConfigProvider
		 */
		private $loggerConfig;

		function __construct(ILoggerConfigProvider $loggerConfigProvider)
		{
			$this->loggerConfigProvider = $loggerConfigProvider;
		}

		/**
		 * @return ILogger
		 */
		function createLogger() {
			$log = new MonologLogger('application');
			foreach ($this->loggerConfigProvider->getConfigs() as $loggerConfig) {
				$handler = new StreamHandler(
						$loggerConfig->getLogFilePath(),
						$loggerConfig->getLogLevel()
				);
				$handler->setFormatter( new ExceptionLineFormatter() );
				$log->pushHandler( $handler );
			}
			return new Logger($log);
		}
	}
