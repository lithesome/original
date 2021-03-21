<?php

	namespace Core\Classes\Router;

	use Core\Interfaces\Router\Maker as MakerInterface;

	/**
	 * Class Router
	 * @package Core\Classes\Router
	 * @method static |self any($pattern)
	 * @method static |self get($pattern)
	 * @method static |self post($pattern)
	 * @method static |self put($pattern)
	 * @method static |self delete($pattern)
	 * @method static |self patch($pattern)
	 * @method static |self options($pattern)
	 * @method static |self head($pattern)
	 * @method static |self connect($pattern)
	 * @method static |self trace($pattern)
	 */
	class Maker implements MakerInterface
	{
		private $route = array(
			'controller' => '',
			'action' => '',
			'pattern' => '',
			'mask' => '([a-z0-9_]+)',
			'modifier' => 'i',
			'method' => 'get',
			'status' => STATUS_ACTIVE,
		);

		public static function __callStatic($name, $arguments)
		{
			return self::register($name, $arguments[0]);
		}

		public static function register($method, $pattern)
		{
			return new self($method, $pattern);
		}

		public function addRoute($route_key)
		{
			return Router::addRoute($route_key, $this->route);
		}

		public function __construct($method, $pattern)
		{
			$this->method($method);
			$this->pattern($pattern);
		}

		public function controller($value)
		{
			$this->route['controller'] = $value;
			return $this;
		}

		public function action($value)
		{
			$this->route['action'] = $value;
			return $this;
		}

		public function pattern($value)
		{
			$this->route['pattern'] = $value;
			return $this;
		}

		public function mask($value)
		{
			$this->route['mask'] = $value;
			return $this;
		}

		public function modifier($value)
		{
			$this->route['modifier'] = $value;
			return $this;
		}

		public function method($value)
		{
			$this->route['method'] = strtolower($value);
			return $this;
		}

		public function status($value)
		{
			$this->route['status'] = $value;
			return $this;
		}

		public function custom($key, $value)
		{
			$this->route[$key] = $value;
			return $this;
		}

		public function getRoute()
		{
			return $this->route;
		}
	}