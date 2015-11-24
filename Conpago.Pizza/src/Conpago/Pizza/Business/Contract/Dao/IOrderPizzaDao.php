<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-24
	 * Time: 09:51
	 */

	namespace Conpago\Pizza\Business\Contract\Dao;


	interface IOrderPizzaDao {
		function getIngredients(array $ingredients);
	}