<?php

	namespace Core\Classes\Controller;

	use Core\Classes\Config;
	use Core\Classes\Hooks\Hooks;
	use Core\Classes\Request;
	use Core\Classes\Response\Response;

	class Controller
	{
		/** @var Request */
		protected $request;
		/** @var Response */
		protected $response;
		/** @var Hooks */
		protected $hooks;

		public function __call($name, $arguments)
		{
			$this->response->setCode(405);
			return $this;
		}

		public static function __callStatic($name, $arguments)
		{
			return Response::getInstance()
				->setCode(405);
		}

		public function __construct()
		{
			$this->request = Request::getInstance();
			$this->response = Response::getInstance();
			$this->hooks = Hooks::getInstance();
		}

		public static function controllerExists($controller_short_name)
		{
			return Config::get($controller_short_name, 'controller_name') ? true : false;
		}
	}