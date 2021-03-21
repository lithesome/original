<?php

	namespace Core\Classes;

	/**
	 * Class Config
	 * @package Core\Classes
	 * @method static core($key, $value = null)
	 * @method static mail($key, $value = null)
	 * @method static cache($key, $value = null)
	 * @method static database($key, $value = null)
	 * @method static session($key, $value = null)
	 * @method static templates($key, $value = null)
	 * @method static MySQLi($key, $value = null)
	 * @method static captcha($key, $value = null)
	 */
	class Config
	{
		const CACHED_FILE = 'tmp/config/config.php';

		private static $config = array();

		private static $instance;
		protected $cached_config_file;

		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public static function __callStatic($name, $arguments)
		{
			if (key_exists(1, $arguments)) {
				return self::set($name, $arguments[0], $arguments[1]);
			}
			return self::get($name, $arguments[0]);
		}

		public static function get($controller, $key)
		{
			if (isset(self::$config[$controller][$key])) {
				return self::$config[$controller][$key];
			}
			return null;
		}

		public static function set($controller, $key, $value)
		{
			self::$config[$controller][$key] = $value;
			return true;
		}

		public function __construct()
		{
			$this->cached_config_file = get_root_path(self::CACHED_FILE);
		}

		public function setConfigs()
		{
			if (file_exists($this->cached_config_file)) {
				self::$config = include $this->cached_config_file;
				return $this;
			}
			$this->setMainConfig();
			$this->findConfigInControllersDirectories();
			return $this;
		}

		protected function setMainConfig()
		{
			$main_config_file = get_root_path('config.php');
			include_once $main_config_file;
		}

		protected function findConfigInControllersDirectories()
		{
			foreach (get_dirs_list(get_root_path('Controllers')) as $controller) {
				$config_file = $controller . '/assets/config.php';
				if (file_exists($config_file)) {
					include_once $config_file;
				}
			}
			return $this;
		}

		public static function getConfigsRawList()
		{
			return self::$config;
		}
	}