<?php
/**
 * Created by PhpStorm.
 * User: Bartosz Gołek
 * Date: 09.11.13
 * Time: 21:23
 */

	return [
		'app' => [
			'default_interactor' => 'HelloWorld',
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