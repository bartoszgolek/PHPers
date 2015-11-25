<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:24
	 */

	namespace Conpago\Pizza\Business\Interactor;


	use Conpago\Pizza\Business\Contract\PresenterModel\IPizza;

	class Pizza implements IPizza{
		protected $ingredients;
		protected $double_dough;
		protected $sauces;

		/**
		 * Pizza constructor.
		 *
		 * @param $ingredients
		 * @param $double_dough
		 */
		public function __construct($ingredients, $double_dough) {
			$this->ingredients = $ingredients;
			$this->double_dough = $double_dough;
			$this->sauces = [];
		}

		function getIngredients() {
			return $this->ingredients;
		}

		function getDoubleDough() {
			return $this->double_dough;
		}

		function getSauces() {
			return $this->sauces;
		}

		public function addSauces( $sauces ) {
			foreach ($sauces as $sauce)
				$this->sauces[] = $sauce;
		}
	}