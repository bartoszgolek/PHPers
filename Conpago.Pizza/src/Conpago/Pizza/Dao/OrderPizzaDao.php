<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-24
	 * Time: 09:56
	 */

	namespace Conpago\Pizza\Dao;


	use Conpago\Pizza\Business\Contract\Dao\IOrderPizzaDao;
	use Conpago\Pizza\Business\Contract\Model\Ingredient;

	class OrderPizzaDao implements IOrderPizzaDao {

		/**
		 * @param string[] $ingredient_names
		 *
		 * @return Ingredient[]
		 */
		function getIngredients(array $ingredient_names) {
			$func = function($ingredient){
				return new Ingredient($ingredient);
			};

			return array_map($func, $ingredient_names);
		}
	}