<?php

	namespace Core\Classes;

	/**
	 * Class Server
	 * @package Core\Classes
	 */
	class Server
	{
		public static function __callStatic($name, $arguments)
		{
		}

		public function __construct()
		{
		}

		public static function get($key)
		{
			return self::isset($key) ? $_SERVER[$key] : null;
		}

		public static function set($key, $value)
		{
			$_SERVER[$key] = $value;
		}

		public static function unset($key)
		{
			if (self::isset($key)) {
				unset($_SERVER[$key]);
				return true;
			}
			return false;
		}

		public static function isset($key)
		{
			return isset($_SERVER[$key]);
		}
	}