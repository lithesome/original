<?php

	namespace Core\Classes\Filesystem;

	class PHP
	{
		protected $file;

		protected $data = array();

		public static function open($file)
		{
			return new self($file);
		}

		public static function delete($file)
		{
			if (file_exists($file)) {
				return unlink($file);
			}
			return false;
		}

		public function __construct($file)
		{
			$this->file = $file;
			if (file_exists($this->file)) {
				$this->data = include $this->file;
			}
		}

		public function getAll()
		{
			return $this->data;
		}

		public function get($key)
		{
			if ($this->isset($key)) {
				return $this->data[$key];
			}
			return null;
		}

		public function set($key, $value)
		{
			$this->data[$key] = $value;
			return $this;
		}

		public function isset($key)
		{
			return isset($this->data[$key]);
		}

		public function unset($key)
		{
			if ($this->isset($key)) {
				unset($this->data[$key]);
			}
			return $this;
		}

		public function save()
		{
			make_dir(dirname($this->file));
			$file = file_put_contents($this->file, php_encode($this->data));
			$this->data = array();
			return $file;
		}
	}