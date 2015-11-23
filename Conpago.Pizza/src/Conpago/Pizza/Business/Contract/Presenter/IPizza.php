<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:00
	 */

	namespace Conpago\Pizza\Business\Contract\Presenter;


	interface IPizza {
		function getIngredients();
		function getDoubleDough();
		function getSauces();
	}