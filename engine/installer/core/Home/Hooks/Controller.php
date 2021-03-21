<?php

	namespace Controllers\Home\Hooks;

	use Controllers\Home\Config;
	use Core\Classes\Router\Router;
	use Core\Classes\Response\Response;

	class Controller
	{
		private $router;
		private $response;

		public function __construct()
		{
			$this->router = Router::getInstance();
			$this->response = Response::getInstance();
		}

		public function checkControllerStatus()
		{
			$controller = $this->router->getControllerName();
			if ($controller && !equal(Config::get($controller, 'controller_status'), STATUS_ACTIVE)) {
				$this->response->setCode(404);
			}
			return $this;
		}
	}