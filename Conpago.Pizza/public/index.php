<?php
	use Conpago\AppBuilder;

	require '../vendor/autoload.php';

	$c = include '../config/devel.php';

	$is_debug = $c['devel']['debug'];
		if ($is_debug == true)
		error_reporting(E_ALL);

	$appBuilderFactory = new \Conpago\AppBuilderFactory();
	/** @var AppBuilder $appBuilder */
	$appBuilder = $appBuilderFactory->createAppBuilder("Web", "..");

	if ($c['devel']['debug'] == true)
	{
		$appBuilder->buildApp();
	}
	else
	{
		$appBuilder->readPersistedApp();
	}

	/**
	 * @param AppBuilder $appBuilder
	 * @param Exception $e
	 * @param $is_debug
	 *
	 * @throws Exception
	 */
	function LogException(AppBuilder $appBuilder, \Exception $e, $is_debug ) {
		try {
			$appBuilder->getLogger()->addCritical( 'Exception caught', [ 'exception' => $e ] );
		} finally {
			if ( $is_debug == true ) {
				throw $e;
			}
		}
	}

	try {
		$appBuilder->getApp()->run();
	} catch (\Exception $e)
	{
		LogException($appBuilder, $e, $is_debug );
	}