<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:18
	 */

	namespace Conpago\Pizza\Business\Interactor;


	class RecipeLibrary {

		/**
		 * ReceiptLibrary constructor.
		 */
		public function __construct() {
			$this->recipes = [
				"margarita" => ["sos pomidorowy", "ser"],
				"capriciosa" => ["sos pomidorowy", "ser", "pieczarki"]
			];
		}

		public function getRecipe( $name ) {
			return $this->recipes[$name];
		}
	}