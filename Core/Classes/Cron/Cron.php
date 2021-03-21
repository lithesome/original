<?php

	namespace Core\Classes\Cron;

	class Cron
	{
		const CACHED_FILE = 'tmp/config/cron.php';

		private static $tasks = array();
		private $prepared_list = array();

		protected $cached_tasks_file;

		public static function register($cron_task_key, callable $function)
		{
			$maker = new Maker($cron_task_key);
			call_user_func($function, $maker);
			return self::addCronTask($maker->getCronTasks());
		}

		public static function addCronTask(array $cron_task)
		{
			self::$tasks[] = $cron_task;
			return true;
		}

		public function __construct()
		{
			$this->cached_tasks_file = get_root_path(self::CACHED_FILE);

			$this->getControllersCronTasksList();
			$this->prepareCronTaskList();
		}

		protected function getControllersCronTasksList()
		{
			if (file_exists($this->cached_tasks_file)) {
				self::$tasks = include $this->cached_tasks_file;
				return $this;
			}
			return $this->scanControllersDir();
		}

		public function scanControllersDir()
		{
			foreach (get_dirs_list(get_root_path('Controllers')) as $controller) {
				$cron_file = $controller . "/assets/cron.php";
				if (file_exists($cron_file)) {
					include_once $cron_file;
				}
			}
			return $this;
		}

		protected function prepareCronTaskList()
		{
			foreach (self::$tasks as $task) {
				$this->prepared_list[$this->makeIndex($task['relevance'])] = $task;
			}
			ksort($this->prepared_list);
			return $this;
		}

		public function getTasksList()
		{
			return $this->prepared_list;
		}

		public static function getCronTasksRawList()
		{
			return self::$tasks;
		}

		protected function makeIndex($index)
		{
			if (!isset($this->prepared_list[$index])) {
				return $index;
			}
			return $this->makeIndex($index + 1);
		}
	}