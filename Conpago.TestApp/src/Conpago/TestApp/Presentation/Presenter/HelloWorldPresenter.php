<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-05-21
	 * Time: 20:55
	 */

	namespace Conpago\TestApp\Presentation\Presenter;

	use Conpago\Presentation\Contract\IPlainPresenter;
	use Conpago\TestApp\Business\Contract\Presenter\IHelloWorldPresenter;

	class HelloWorldPresenter implements IHelloWorldPresenter
	{
		/**
		 * @var
		 */
		private $plainPresenter;

		function __construct(IPlainPresenter $plainPresenter)
		{
			$this->plainPresenter = $plainPresenter;
		}

		function showHelloWorld()
		{
			$this->plainPresenter->show("Hello World!!!");
		}
	}