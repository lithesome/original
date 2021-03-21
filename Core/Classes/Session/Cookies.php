<?php

	namespace Core\Classes\Session;

	class Cookies
	{
		private static $instance;

		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct()
		{
		}

		/**
		 * @param $cookie_name
		 * @param $cookie_value
		 * @param $cookie_time
		 * @param string $cookie_path
		 * @param bool $http_only
		 * @param bool $secure
		 * @param null $domain
		 * @return $this
		 */
		public function set($cookie_name, $cookie_value, $cookie_time, $cookie_path = '/', $http_only = false, $secure = false, $domain = null)
		{
			$cookie_time = $cookie_time ? $cookie_time + time() : 0;
			setcookie($cookie_name, $cookie_value, $cookie_time, $cookie_path, $domain, $secure, $http_only);
			return $this;
		}

		public function get($cookie_name)
		{
			if (isset($_COOKIE[$cookie_name])) {
				return $_COOKIE[$cookie_name];
			}
			return null;
		}

		public function is($cookie_name)
		{
			if (isset($_COOKIE[$cookie_name])) {
				return true;
			}
			return false;
		}

		public function unset($cookie_name)
		{
			$this->set($cookie_name, null, -time());
			return $this;
		}
	}