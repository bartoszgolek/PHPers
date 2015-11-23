<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-03-29
	 * Time: 11:44
	 */

	namespace Conpago\Pizza\Business\Contract\Presenter;

	interface IOrderPizzaPresenter
	{
		public function deliver(IPizza $pizza);
	}