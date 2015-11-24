<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-11-24
	 * Time: 10:34
	 */

	namespace Conpago\Pizza\Business\Contract\Dao;


	class Ingredient {

		protected $name;

		function __construct($name)
		{
			$this->name = $name;
		}

		function getName(){
			return $this->name;
		}
	}