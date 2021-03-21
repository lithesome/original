<?php

	namespace Core\Classes;

	class stdClass extends \stdClass
	{
		public $data;

		public function __get($name)
		{
			return $this->get($name);
		}

		public function __set($name, $value)
		{
			return $this->set($name, $value);
		}

		public function __call($name, $arguments)
		{
			if (key_exists(0, $arguments)) {
				return $this->set($name, ...$arguments);
			}
			return $this->get($name);
		}

		public function __construct()
		{
		}

		public function get($key = null)
		{
			return !$key ? $this->data : isset($this->data[$key]) ? $this->data[$key] : null;
		}

		public function set($key, $value)
		{
			$this->data[$key] = $value;
			return $this;
		}
	}