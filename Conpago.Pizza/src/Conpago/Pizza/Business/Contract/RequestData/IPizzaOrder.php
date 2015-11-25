<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:02
	 */

	namespace Conpago\Pizza\Business\Contract\RequestData;


	interface IPizzaOrder {
		function getName();
		function getDoubleDough();
		function getSauces();
	}