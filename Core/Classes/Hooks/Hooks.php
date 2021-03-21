<?php

	namespace Core\Classes\Hooks;

	use Core\Classes\Response\Response;

	class Hooks
	{
		const CACHED_FILE = 'tmp/config/hooks.php';

		private static $instance;

		private static $raw_list = array();
		private $prepared_list = array();
		protected $cached_hooks_file;

		/** @var Response */
		public $response;

		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public static function register($event_key, callable $callback)
		{
			$maker = new Maker();
			call_user_func($callback, $maker);
			return self::setHook($event_key, $maker->getHooks());
		}

		public static function setHook($event_key, array $hook)
		{
			self::$raw_list[$event_key][] = $hook;
			return true;
		}

		public function __construct()
		{
			$this->cached_hooks_file = get_root_path(self::CACHED_FILE);

			$this->response = Response::getInstance();
			$this->setHooksList();
			$this->sortHooksList();
		}

		public function run($event_key, ...$arguments)
		{
			$time = microtime(true);
			$result = array();
			if (isset($this->prepared_list[$event_key])) {
				foreach ($this->prepared_list[$event_key] as $hook) {
					if (!equal($hook['status'], STATUS_ACTIVE)) {
						continue;
					}
					$this->response->setDebug('Home.debug.debug_hooks', $time, array(
						$event_key,
						$hook['class'],
						$hook['method'] . '()'), debug_backtrace()
					);
					$result[$hook['class']] = call_user_func(array(new $hook['class'](), $hook['method']), ...$hook['arguments'], ...$arguments);
				}
			}
			return $result;
		}

		public function after($event_key, ...$arguments)
		{
			$event_key = "{$event_key}_after";
			return $this->run($event_key, ...$arguments);
		}

		public function before($event_key, ...$arguments)
		{
			$event_key = "{$event_key}_before";
			return $this->run($event_key, ...$arguments);
		}

		protected function sortHooksList()
		{
			foreach (self::$raw_list as $key => $hooks_list) {
				foreach ($hooks_list as $hook) {
					$index = $this->makeIndex($key, $hook['relevance']);
					$this->prepared_list[$key][$index] = $hook;
				}
				ksort($this->prepared_list[$key]);
			}
			return $this;
		}

		protected function setHooksList()
		{
			if (file_exists($this->cached_hooks_file)) {
				self::$raw_list = include $this->cached_hooks_file;
				return $this;
			}
			return $this->scanControllersDir();
		}

		protected function scanControllersDir()
		{
			foreach (get_dirs_list(get_root_path('Controllers')) as $controller) {
				$hooks_file = $controller . "/assets/hooks.php";
				if (file_exists($hooks_file)) {
					include_once $hooks_file;
				}
			}
			return $this;
		}

		protected function makeIndex($key, $index)
		{
			if (!isset($this->prepared_list[$key][$index])) {
				return $index;
			}
			return $this->makeIndex($key, $index + 1);
		}

		public static function getHooksRawList()
		{
			return self::$raw_list;
		}

		public function getHooksList()
		{
			return $this->prepared_list;
		}
	}