<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-05-21
	 * Time: 20:55
	 */

	namespace Conpago\Pizza\Presentation\Presenter;

	use Conpago\Presentation\Contract\IJsonPresenter;
	use Conpago\Pizza\Business\Contract\Presenter\IHelloWorldPresenter;

	class HelloWorldPresenter implements IHelloWorldPresenter
	{
		/**
		 * @var
		 */
		private $jsonPresenter;

		function __construct(IJsonPresenter $jsonPresenter)
		{
			$this->jsonPresenter = $jsonPresenter;
		}

		function showHelloWorld()
		{
			$data['success'] = true;
			$data['text'] = "Hello World!!!";
			$this->jsonPresenter->showJson($data);
		}
	}