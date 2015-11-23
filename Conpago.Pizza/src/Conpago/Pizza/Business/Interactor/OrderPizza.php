<?php

	namespace Conpago\Pizza\Business\Interactor;

	use Conpago\Pizza\Business\Contract\Interactor\IOrderPizza;
	use Conpago\Pizza\Business\Contract\Presenter\IOrderPizzaPresenter;
	use Conpago\Pizza\Business\Contract\RequestData\IPizzaOrder;

	class OrderPizza implements IOrderPizza
	{
		/**
		 * @var RecipeLibrary
		 */
		protected $recipe_library;
		/**
		 * @var Owen
		 */
		protected $owen;
		/**
		 * @var IOrderPizzaPresenter
		 */
		private $presenter;

		public function __construct(
			IOrderPizzaPresenter $presenter
		)
		{
			$this->recipe_library = new RecipeLibrary();
			$this->presenter      = $presenter;
		}

		public function run(IPizzaOrder $order)
		{
			$recipe = $this->recipe_library->getRecipe($order->getName());

			$pizza = $this->makePizza($recipe, $order->getDoubleDough());
			$baked_pizza = $this->owen->bake($pizza);
			$baked_pizza->addSauces($order->getSauces());

			$this->presenter->deliver($baked_pizza);
		}

		/**
		 * @param $recipe
		 * @param $getDoubleDough
		 *
		 * @return RawPizza
		 */
		private function makePizza( $recipe, $getDoubleDough ) {
			return new RawPizza($getDoubleDough, $recipe);
		}
	}
