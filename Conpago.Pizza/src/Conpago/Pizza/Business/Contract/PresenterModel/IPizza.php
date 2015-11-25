<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:00
	 */

	namespace Conpago\Pizza\Business\Contract\PresenterModel;


	interface IPizza {
		function getIngredients();
		function getDoubleDough();
		function getSauces();
	}