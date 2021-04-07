<?php

	namespace Core\Classes\Test;

	class Test
	{
		private static $tests_raw_list = array();

		protected $tests_list = array();

		public static function register(callable $callback)
		{
			$maker = new Maker();
			call_user_func($callback, $maker);
			return self::addTest($maker->getTest());
		}

		public static function addTest(array $test)
		{
			self::$tests_raw_list[] = $test;
			return true;
		}

		public function __construct()
		{
			$this->scanControllersDir();
			$this->sortTestsList();
		}

		public static function getRawList()
		{
			return self::$tests_raw_list;
		}

		public function getTestsList()
		{
			return $this->tests_list;
		}

		protected function sortTestsList()
		{
			foreach (self::$tests_raw_list as $test) {
				$this->tests_list[$this->makeIndex($test['relevance'])] = $test;
			}
			ksort($this->tests_list);
			return $this;
		}

		protected function scanControllersDir()
		{
			foreach (get_dirs_list(get_root_path('Controllers')) as $controller) {
				$tests_file = $controller . "/assets/test.php";
				if (file_exists($tests_file)) {
					include_once $tests_file;
				}
			}
			return $this;
		}

		protected function makeIndex($index)
		{
			if (!isset($this->tests_list[$index])) {
				return $index;
			}
			return $this->makeIndex($index + 1);
		}
	}