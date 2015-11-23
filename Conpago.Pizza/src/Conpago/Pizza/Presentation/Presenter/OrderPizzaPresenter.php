<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-05-21
	 * Time: 20:55
	 */

	namespace Conpago\Pizza\Presentation\Presenter;

	use Conpago\Pizza\Business\Contract\Presenter\IPizza;
	use Conpago\Presentation\Contract\IJsonPresenter;
	use Conpago\Pizza\Business\Contract\Presenter\IOrderPizzaPresenter;

	class OrderPizzaPresenter implements IOrderPizzaPresenter
	{
		/**
		 * @var
		 */
		private $jsonPresenter;

		function __construct(IJsonPresenter $jsonPresenter)
		{
			$this->jsonPresenter = $jsonPresenter;
		}

		function deliver(IPizza $pizza)
		{
			$this->jsonPresenter->showJson($pizza);
		}
	}