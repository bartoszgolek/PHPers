<?php

	namespace Conpago\Pizza\Business\Interactor;

	use Conpago\Pizza\Business\Contract\Dao\IOrderPizzaDao;
	use Conpago\Pizza\Business\Contract\Interactor\IOrderPizza;
	use Conpago\Pizza\Business\Contract\Model\Ingredient;
	use Conpago\Pizza\Business\Contract\Presenter\IOrderPizzaPresenter;
	use Conpago\Pizza\Business\Contract\RequestData\IPizzaOrder;

	class OrderPizza implements IOrderPizza
	{
		/**
		 * OrderPizza constructor.
		 *
		 * @param IOrderPizzaPresenter $presenter
		 * @param IOrderPizzaDao $orderPizzaDao
		 */
		public function __construct(
			IOrderPizzaPresenter $presenter,
			IOrderPizzaDao $orderPizzaDao
		)
		{
			$this->recipe_library = new RecipeLibrary();
			$this->owen = new Owen();
			$this->presenter      = $presenter;
			$this->orderPizzaDao = $orderPizzaDao;
		}

		public function run(IPizzaOrder $order)
		{
			$recipe = $this->recipe_library->getRecipe($order->getName());

			$ingredients = $this->orderPizzaDao->getIngredients($recipe);

			$pizza = $this->makePizza($ingredients, $order->getDoubleDough());
			$baked_pizza = $this->owen->bake($pizza);
			$baked_pizza->addSauces($order->getSauces());

			$this->presenter->deliver($baked_pizza);
		}
		//...//

		/**
		 * @param Ingredient[] $ingredients
		 * @param $getDoubleDough
		 *
		 * @return RawPizza
		 */
		private function makePizza(array $ingredients, $getDoubleDough ) {
			return new RawPizza($getDoubleDough, $ingredients);
		}

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
		/**
		 * @var IOrderPizzaDao
		 */
		private $orderPizzaDao;
	}
