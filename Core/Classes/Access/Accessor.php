<?php

	namespace Core\Classes\Access;

	/**
	 * Class Accessor
	 * @package Core\Classes\Access
	 * @method static |self granted($access_class_name = \Core\Classes\Access\Granted::class)
	 * @method static |self denied($access_class_name = \Core\Classes\Access\Denied::class)
	 * @method self checkControllers(...$arguments)
	 * @method self checkUrlMasks(...$arguments)
	 * @method self checkGroups(...$arguments)
	 */
	class Accessor
	{
		private $access;

		private $params = array();

		public static function __callStatic($name, $arguments)
		{
			return new self($name, ...$arguments);
		}

		public function __call($name, $arguments)
		{
			return $this->method($name, ...$arguments);
		}

		public function __construct($access, $access_class_name = null)
		{
			$this->access($access, $access_class_name);
		}

		public function access($access, $access_class_name = null)
		{
			$this->access = $access;
			return $this->accessorClass($access_class_name ? $access_class_name :
				(equal($access, 'granted') ? Granted::class : Denied::class)
			);
		}

		public function accessorClass($access_class_name)
		{
			$this->params[$this->access]['accessor'] = $access_class_name;
			return $this;
		}

		public function method($method, ...$method_arguments)
		{
			$this->params[$this->access]['methods'][$method] = $method_arguments;
			return $this;
		}

		public function getParams()
		{
			return $this->params;
		}
	}