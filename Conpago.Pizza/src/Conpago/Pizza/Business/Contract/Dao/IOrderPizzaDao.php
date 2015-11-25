<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-24
	 * Time: 09:51
	 */

	namespace Conpago\Pizza\Business\Contract\Dao;


	use Conpago\Pizza\Business\Contract\Model\Ingredient;

	interface IOrderPizzaDao {
		/**
		 * @param string[] $ingredient_names
		 *
		 * @return Ingredient[]
		 */
		function getIngredients(array $ingredient_names);
	}