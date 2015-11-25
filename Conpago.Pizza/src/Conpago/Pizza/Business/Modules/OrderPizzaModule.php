<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Conpago\Pizza\Business\Modules;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\IModule;

	class OrderPizzaModule implements IModule
	{

		/**
		 * @param IContainerBuilder $builder
		 *
		 * @SuppressWarnings(PHPMD.StaticAccess)
		 */
		public function build(IContainerBuilder $builder)
		{
			$builder->registerType('Conpago\Pizza\Presentation\Controller\OrderPizzaController')
				->asA('Conpago\IController')
				->asA('Conpago\Pizza\Presentation\Contract\Controller\IOrderPizzaController')
				->keyed('OrderPizzaController')
				->singleInstance();

			$builder->registerType('Conpago\Pizza\Business\Interactor\OrderPizza')
				->asA('Conpago\Pizza\Business\Contract\Interactor\IOrderPizza')
				->named('OrderPizza')
				->singleInstance();

			$builder->registerType('Conpago\Pizza\Presentation\Presenter\JsonOrderPizzaPresenter')
				->asA('Conpago\Pizza\Business\Contract\Presenter\IOrderPizzaPresenter')
				->singleInstance();

			$builder->registerType('Conpago\Pizza\Dao\OrderPizzaDao')
				->asA('Conpago\Pizza\Business\Contract\Dao\IOrderPizzaDao')
				->singleInstance();
		}
	}