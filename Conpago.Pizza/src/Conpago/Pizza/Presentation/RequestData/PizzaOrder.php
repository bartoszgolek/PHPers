<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-23
	 * Time: 14:07
	 */

	namespace Conpago\Pizza\Presentation\RequestData;


	use Conpago\Pizza\Business\Contract\RequestData\IPizzaOrder;

	class PizzaOrder implements IPizzaOrder{

		protected $name;
		protected $double_dough;
		protected $sauces;

		function __construct($name, $double_dough, $sauces) {
			$this->name = $name;
			$this->double_dough = $double_dough;
			$this->sauces = $sauces;
		}

		function getName() {
			return $this->name;
		}

		function getDoubleDough() {
			return $this->double_dough;
		}

		function getSauces() {
			return $this->sauces;
		}
	}