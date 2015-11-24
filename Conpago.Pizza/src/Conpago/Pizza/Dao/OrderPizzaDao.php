<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-24
	 * Time: 09:56
	 */

	namespace Conpago\Pizza\Dao;


	use Conpago\Pizza\Business\Contract\Dao\Ingredient;
	use Conpago\Pizza\Business\Contract\Dao\IOrderPizzaDao;

	class OrderPizzaDao implements IOrderPizzaDao {

		function getIngredients( array $ingredients ) {
			$func = function($ingredient){
				return new Ingredient($ingredient);
			};

			return array_map($func, $ingredients);
		}
	}