<?php

	namespace Core\Classes;

	class Language
	{
		private static $instance;

		private $language_data = array();

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

		public static function getLanguageKey()
		{
			return Config::core('default_language');
		}

		protected function setLanguageData($controller, $language_key)
		{
			$language_file = get_root_path('Controllers/' . $controller . '/language/' . $language_key . '.php');
			if (file_exists($language_file)) {
				return include $language_file;
			}
			return array();
		}

		protected function setCachedLanguage($controller, $language_key)
		{
			$language_file = get_root_path('tmp/locales/' . $controller . '/' . $language_key . '.php');
			if (file_exists($language_file)) {
				return include $language_file;
			}
			return $this->setLanguageData($controller, $language_key);
		}

		public function getLanguageValue($controller, $key)
		{
			$language_key = Config::core('default_language');
			if (!isset($this->language_data[$controller][$language_key])) {
				$this->language_data[$controller][$language_key] = $this->setCachedLanguage($controller, $language_key);
			}
			return isset($this->language_data[$controller][$language_key][$key]) ? $this->language_data[$controller][$language_key][$key] : null;
		}

		public function getLanguageData($controller = null, $language_key = null, $key = null)
		{
			if ($controller) {
				return isset($this->language_data[$controller]) ? $this->language_data[$controller] : array();
			}
			if ($controller && $language_key) {
				return isset($this->language_data[$controller][$language_key]) ? $this->language_data[$controller][$language_key] : array();
			}
			if ($controller && $language_key && $key) {
				return isset($this->language_data[$controller][$language_key][$key]) ? $this->language_data[$controller][$language_key][$key] : null;
			}
			return $this->language_data;
		}

		public function getAllControllersLanguages($language_key)
		{
			$languages = array();
			foreach (get_dirs_list(get_root_path('Controllers')) as $controller) {
				$controller = basename($controller);
				$languages[$controller] = $this->setCachedLanguage($controller, $language_key);
			}
			return $languages;
		}
	}