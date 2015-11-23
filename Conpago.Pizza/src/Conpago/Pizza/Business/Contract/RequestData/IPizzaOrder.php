<?php

	namespace Conpago\Pizza\Business\Contract\RequestData;

	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:02
	 */
	interface IPizzaOrder {
		function getName();
		function getDoubleDough();
		function getSauces();
	}