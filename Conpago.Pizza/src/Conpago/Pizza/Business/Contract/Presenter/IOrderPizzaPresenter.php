<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-03-29
	 * Time: 11:44
	 */

	namespace Conpago\Pizza\Business\Contract\Presenter;

	use Conpago\Pizza\Business\Contract\PresenterModel\IPizza;

	interface IOrderPizzaPresenter
	{
		public function deliver(IPizza $pizza);
	}