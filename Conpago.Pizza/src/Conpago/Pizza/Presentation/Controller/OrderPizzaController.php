<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-05-21
	 * Time: 21:27
	 */

	namespace Conpago\Pizza\Presentation\Controller;

	use Conpago\Helpers\Contract\IRequestData;
	use Conpago\Pizza\Business\Contract\Interactor\IOrderPizza;
	use Conpago\Pizza\Presentation\Contract\Controller\IOrderPizzaController;
	use Conpago\Pizza\Presentation\RequestData\PizzaOrder;

	class OrderPizzaController implements IOrderPizzaController
	{
		/**
		 * @var IOrderPizza
		 */
		private $orderPizza;

		function __construct(IOrderPizza $orderPizza)
		{
			$this->orderPizza = $orderPizza;
		}

		/**
		 * @param IRequestData $data
		 *
		 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
		 */
		function execute(IRequestData $data)
		{
			$parameters = $data->getParameters();
			$order = $parameters["order"];
			$this->orderPizza->run(new PizzaOrder(
				$order["name"],
				$order["double_dough"],
				$order["sauces"]
			));
		}
	}