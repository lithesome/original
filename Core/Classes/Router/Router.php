<?php

	namespace Core\Classes\Router;

	use Core\Classes\Request;
	use Core\Classes\Hooks\Hooks;
	use Core\Classes\Response\Response;

	/**
	 * Class Router
	 * @package Core\Classes\Router
	 * @method static any($route_key, $pattern, callable $callback)
	 * @method static get($route_key, $pattern, callable $callback)
	 * @method static post($route_key, $pattern, callable $callback)
	 * @method static put($route_key, $pattern, callable $callback)
	 * @method static delete($route_key, $pattern, callable $callback)
	 * @method static patch($route_key, $pattern, callable $callback)
	 * @method static options($route_key, $pattern, callable $callback)
	 * @method static head($route_key, $pattern, callable $callback)
	 * @method static connect($route_key, $pattern, callable $callback)
	 * @method static trace($route_key, $pattern, callable $callback)
	 */
	class Router
	{
		const CACHED_FILE = 'tmp/config/router.php';

		private static $routes = array();
		protected $cached_routes_file;

		private $request_uri;
		private $request_method;

		private $controller_name;

		private $route = array(
			'controller' => '',
			'action' => '',
			'pattern' => '',
			'mask' => '',
			'modifier' => '',
			'method' => '',
			'status' => '',
		);

		private $true_action;

		/** @var Request */
		private $request;
		/** @var Response */
		private $response;
		/** @var Hooks */
		private $hooks;

		private static $instance;

		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public static function __callStatic($name, $arguments)
		{
			return self::registerRoute($name, $arguments[0], $arguments[1], $arguments[2]);
		}

		public static function registerRoute($method, $route_key, $pattern, callable $callback_function)
		{
			$routes_maker = new Maker($method, $pattern);
			call_user_func($callback_function, $routes_maker);
			return self::addRoute($route_key, $routes_maker->getRoute());
		}

		public static function addRoute($route_key, array $route)
		{
			self::$routes[$route_key] = $route;
			return true;
		}

		public static function getRoutesRawList()
		{
			return self::$routes;
		}

		public function __construct()
		{
			$this->cached_routes_file = get_root_path(self::CACHED_FILE);

			$this->request = Request::getInstance();
			$this->response = Response::getInstance();
			$this->hooks = Hooks::getInstance();
			$this->request_uri = $this->request->getRequestUri();
			$this->request_method = $this->request->getRequestMethod();
			$this->setRoutes();
		}

		private function setRoutes()
		{
			if (file_exists($this->cached_routes_file)) {
				self::$routes = include $this->cached_routes_file;
				return $this;
			}
			return $this->getRouterFiles();
		}

		private function getRouterFiles()
		{
			foreach (get_dirs_list(get_root_path('Controllers')) as $controller) {
				$router_file = $controller . '/assets/router.php';
				if (file_exists($router_file)) {
					include_once $router_file;
				}
			}
			return $this;
		}

		public function searchCurrentUrl()
		{
			foreach (self::$routes as $router) {
				if ($this->parsePattern($router)) {
					break;
				}
			}
			return $this->checkAction();
		}

		protected function checkAction()
		{
			if (!$this->route['action'] && equal($this->route['method'], 'any')) {
				$this->route['action'] = $this->request_method . 'Method';
				$this->true_action = basename(str_replace('\\', DIRECTORY_SEPARATOR, $this->route['controller']));
				return $this;
			}
			return $this->setAction($this->route['action']);
		}

		protected function checkRequestMethod($method)
		{
			if (equal($method, $this->request_method) || equal($method, 'any')) {
				return true;
			}
			return false;
		}

		protected function checkEnablingRoute($status)
		{
			if (equal($status, STATUS_ACTIVE)) {
				return true;
			}
			return false;
		}

		public static function replacePattern($mask, $pattern)
		{
			$pattern = str_replace(
				array('{integer}', '{int}', '{i}', '{string}', '{str}', '{s}'),
				array('([0-9]+)', '([0-9]+)', '([0-9]+)', '([a-z]+)', '([a-z]+)', '([a-z]+)'),
				$pattern
			);
			$result = preg_replace("#\{(.*?)\}#", $mask, $pattern);
			return $result;
		}

		protected function parsePattern($route)
		{
			$pattern = trim(self::replacePattern($route['mask'], $route['pattern']), '/');
			preg_match("#{$pattern}#{$route['modifier']}", $this->request_uri, $params);
			if (isset($params[0])
				&& equal($params[0], $this->request_uri)
				&& equal($route['status'], STATUS_ACTIVE)
				&& $this->checkRequestMethod($route['method'])) {
				$params = array_slice($params, 1);
				$route['params'] = isset($route['params']) && !empty($route['params']) ? array_merge($route['params'], $params) : $params;
				return $this->setController($route);
			}
			return false;
		}

		public function setController($route)
		{
			$this->route = $route;
			return $this->setControllerName($route['controller']);
		}

		public function runController()
		{
			if (!$this->route['controller'] || !$this->route['action']) {
				$this->response->setCode(404);
				return $this;
			}

			if (!method_exists($this->route['controller'], $this->route['action'])
				/*|| !$this->checkRequestMethod($this->route['method'])*/) {
				$this->response->setCode(405);
				return $this;
			}

			$this->hooks->before('run_controller');
			$this->executeController($this->route['controller'], $this->route['action'], $this->route['params']);
			$this->hooks->after('run_controller');

			return $this;
		}

		public function executeController($controller, $action, array $params)
		{
			if ($this->response->getCode() < 400) {
				$controller_instance = method_exists($controller, 'getInstance') ?
					$controller::getInstance() : new $controller;
				$hook_name = "{$this->controller_name}::{$this->true_action}";
				$this->hooks->before($hook_name, $controller_instance);
				$action_instance = call_user_func_array(array($controller_instance, $action), $params);
				if (!$action_instance) {
					$this->response->setCode(404);
				}
				$this->hooks->after($hook_name, $action_instance);
				return $action_instance;
			}
			return false;
		}

		public static function prepareControllerName($controller_class)
		{
			$controller_class_segments = explode('\\', $controller_class);
			return isset($controller_class_segments[1]) ? $controller_class_segments[1] : null;
		}

		public function setControllerName($controller_class)
		{
			$this->controller_name = self::prepareControllerName($controller_class);
			return $this;
		}

		public function getControllerName()
		{
			return $this->controller_name;
		}

		public function getAction()
		{
			return $this->true_action;
		}

		public function setAction($true_action)
		{
			$this->true_action = $true_action;
			return $this;
		}

		public function getRoute($key = null)
		{
			if ($key) {
				if (isset($this->route[$key])) {
					return $this->route[$key];
				}
				return null;
			}
			return $this->route;
		}
	}