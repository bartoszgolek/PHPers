<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:22
	 */

	namespace Conpago\Pizza\Business\Interactor;


	use Conpago\Pizza\Business\Contract\Model\Ingredient;

	class RawPizza {
		private $double_dough;
		private $ingredients;

		/**
		 * RawPizza constructor.
		 *
		 * @param $double_dough
		 * @param Ingredient[] $ingredients
		 */
		public function __construct( $double_dough, $ingredients ) {
			$this->double_dough = $double_dough;
			$this->ingredients  = $ingredients;
		}

		/**
		 * @return mixed
		 */
		public function getDoubleDough() {
			return $this->double_dough;
		}

		/**
		 * @return Ingredient[]
		 */
		public function getIngredients() {
			return $this->ingredients;
		}
	}