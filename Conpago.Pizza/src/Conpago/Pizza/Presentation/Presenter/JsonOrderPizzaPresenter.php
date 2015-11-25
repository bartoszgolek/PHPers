<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-05-21
	 * Time: 20:55
	 */

	namespace Conpago\Pizza\Presentation\Presenter;

	use StdClass;
	use Conpago\Pizza\Business\Contract\Model\Ingredient;
	use Conpago\Pizza\Business\Contract\PresenterModel\IPizza;
	use Conpago\Pizza\Business\Contract\Presenter\IOrderPizzaPresenter;
	use Conpago\Presentation\Contract\IJsonPresenter;


	class JsonOrderPizzaPresenter implements IOrderPizzaPresenter
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
			$func = function(Ingredient $i){
				return $i->getName();
			};

			$data = new StdClass;
			$data->ingredients = array_map($func, $pizza->getIngredients());
			$data->double_dough = $pizza->getDoubleDough();
			$data->sauces = $pizza->getSauces();

			$this->jsonPresenter->showJson($data);
		}
	}