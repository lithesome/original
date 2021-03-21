<?php

	namespace Core\Classes\Access;

	use Core\Classes\Request;
	use Core\Classes\Router\Router;
	use Core\Interfaces\Access\Access as AccessInterface;

	class Access implements AccessInterface
	{
		protected $access;

		protected $request;

		protected $router;

		protected $request_uri;
		protected $controller;
		protected $action;

		public function __construct()
		{
			$this->request = Request::getInstance();
			$this->router = Router::getInstance();
			$this->request_uri = $this->request->getRequestUri();
			$this->controller = $this->router->getControllerName();
			$this->action = $this->router->getAction();
		}

		public function checkUrlMask($uri_mask)
		{
			if (!$this->request_uri && !$uri_mask) {
				return true;
			}
			$pattern = preg_replace("#\{(.*?)\}#", '(.*?)', $uri_mask);
			preg_match("#^{$pattern}#ui", $this->request_uri, $result);
			return isset(array_diff($result, array(''))[0]);
		}

		public function checkController($controller, $action)
		{
			return equal($controller, $this->controller) && equal($action, $this->action);
		}

		public function access($status)
		{
			$this->access = $status;
			return $this;
		}

		public function callback(array $arguments)
		{
			if (isset($arguments[0]) && is_callable($arguments[0])) {
				$callback = $arguments[0];
				unset($arguments[0]);
				call_user_func($callback, $this, ...$arguments);
			}
			return $this;
		}
	}