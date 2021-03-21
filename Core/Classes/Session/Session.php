<?php

	namespace Core\Classes\Session;

	use Core\Classes\Config;
	use Core\Classes\Hooks\Hooks;

	/**
	 * Class Session
	 * @package Core\Classes\Session
	 * @method static auth($key, $value = null)
	 * @method static config($key, $value = null)    // not dropable
	 * @method static system($key, $value = null)    // not dropable
	 * @method static other($key, $value = null)
	 * @method static message($key, $value = null)
	 */
	class Session
	{
		private static $instance;

		private $hooks;
		private $cookies;

		private $session_id;
		private $session_dir;

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
				if (is_null($arguments[1])) {
					return self::unset($name, $arguments[0]);
				}
				return self::set($name, $arguments[0], $arguments[1]);
			}
			return self::get($name, $arguments[0]);
		}

		public function __construct()
		{
			$this->hooks = Hooks::getInstance();
			$this->cookies = Cookies::getInstance();
			$this->setSessionID();
			$this->setSessionDir();
		}

		public function setSessionID()
		{
			$this->session_id = $this->cookies->get(Config::session('session_name'));
			if (!$this->session_id) {
				$this->session_id = gen(64);
				$this->hooks->run('new_user', $this->session_id);
			}
			return $this;
		}

		public function setSessionDir()
		{
			$this->session_dir = get_root_path(Config::session('session_dir'));
			make_dir($this->session_dir);
			return $this;
		}

		public function start()
		{
			ini_set('session.gc_maxlifetime', Config::session('session_time'));
			ini_set('session.cookie_lifetime', Config::session('session_time'));
			ini_set('session.cookie_domain', Config::session('session_domain'));
			session_name(Config::session('session_name'));
			session_save_path($this->session_dir);
			session_id($this->session_id);
			session_start();
			return $this;
		}

		public static function get($session_section, $key)
		{
			if (isset($_SESSION[$session_section][$key])) {
				return $_SESSION[$session_section][$key];
			}
			return null;
		}

		public static function getSection($session_section)
		{
			if (isset($_SESSION[$session_section])) {
				return $_SESSION[$session_section];
			}
			return array();
		}

		public static function set($session_section, $key, $value)
		{
			$_SESSION[$session_section][$key] = $value;
			return true;
		}

		public static function append($session_section, $key, $value, $index = null)
		{
			if (isset($_SESSION[$session_section][$key]) && in_array($value, $_SESSION[$session_section][$key])) {
				return true;
			}
			if ($index) {
				$_SESSION[$session_section][$key][$index] = $value;
				return true;
			}
			$_SESSION[$session_section][$key][] = $value;
			return true;
		}

		public static function unset($session_section, $key)
		{
			if (isset($_SESSION[$session_section][$key])) {
				unset($_SESSION[$session_section][$key]);
				return true;
			}
			return false;
		}

		public static function destroy($session_key)
		{
			if (isset($_SESSION[$session_key])) {
				foreach ($_SESSION[$session_key] as $key => $value) {
					unset($_SESSION[$session_key]);
				}
				return true;
			}
			return false;
		}

		public static function getCSRFToken($key_name)
		{
			if ($csrf_token = self::other($key_name)) {
				if (self::other('csrf_expired_time') + Config::session('csrf_expired_time') > time()) {
					return $csrf_token;
				}
			}
			self::other($key_name, gen(64));
			self::other('csrf_expired_time', time());
			return self::other($key_name);
		}

	}