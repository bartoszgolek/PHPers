<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:23
	 */

	namespace Conpago\Pizza\Business\Interactor;


	class Owen {

		/**
		 * @param RawPizza $pizza
		 *
		 * @return Pizza
		 */
		public function bake(RawPizza $pizza ) {

			return new Pizza(
				$pizza->getIngredients(),
				$pizza->getDoubleDough()
			);
		}
	}