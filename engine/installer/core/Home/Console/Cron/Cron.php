<?php

	namespace Controllers\Home\Console\Cron;

	use Core\Classes\Console\Paint\Paint;
	use Core\Classes\Cron\Cron as CronGenerator;
	use Core\Classes\Errors;

	class Cron extends CronGenerator
	{
		private $key;
		private $tasks = array();
		private $log_file = 'tmp/logs/cron.php';
		private $log_data = array();
		private $task_keys = array();

		public function __construct()
		{
			parent::__construct();
			$this->tasks = $this->getTasksList();
			$this->log_file = get_root_path($this->log_file);
			make_dir(dirname($this->log_file));
			$this->getLogsData();
			set_error_handler('Core\\Classes\\Errors::saveDown');
			register_shutdown_function('Core\\Classes\\Errors::saveDown');
			ignore_user_abort(true);
			set_time_limit(0);
		}

		public function __destruct()
		{
			set_error_handler("Core\\Classes\\Errors::except");
			register_shutdown_function('Core\\Classes\\Errors::shutDown');
		}

		protected function getLogsData()
		{
			if (file_exists($this->log_file)) {
				$this->log_data = include $this->log_file;
			}
			return $this;
		}

		public function execute(...$task_keys)
		{
			$this->task_keys = $task_keys;

			foreach ($this->tasks as $task) {
				$this->key = $task['key'];

				if ($this->task_keys && in_array($this->key, $this->task_keys)) {
					$this->runCronTask($task);
					continue;
				}

				if (!$this->checkStatus($task) ||
					!$this->checkLastRun($task) ||
					!$this->checkLocked($task)) {
					continue;
				}

				$this->setLockedStatus(true)
					->updateData()
					->runCronTask($task)
					->setLockedStatus(false)
					->updateData();
			}
			return $this;
		}

		protected function checkLocked($task)
		{
			if (!isset($this->log_data[$this->key]['locked'])) {
				return true;
			}
			if ($this->log_data[$this->key]['locked']) {
				Paint::string(lang('Home.cron.task_locked', array('%task%' => $this->key)))->fonMagenta()->print();
				return $this->checkBrokenTask($task);
			}
			return true;
		}

		protected function checkBrokenTask($task)
		{
			if (!isset($this->log_data[$this->key]['last_run'])) {
				return true;
			}
			$time_to_unlock = $this->log_data[$this->key]['last_run'] + $task['overtime'] + $task['period'];
			if (time() > $time_to_unlock) {
				Paint::string(lang('Home.cron.task_unlocked_by_overtime', array('%task%' => $this->key)))->fonGreen()->print();
				return true;
			}
			return false;
		}

		protected function checkStatus($task)
		{
			if (!equal($task['status'], STATUS_ACTIVE)) {
				Paint::string(lang('Home.cron.task_locked_by_status', array('%task%' => $this->key)))->fonRed()->print();
				return false;
			}
			return true;
		}

		protected function checkLastRun($task)
		{
			if (!isset($this->log_data[$this->key]['last_run'])) {
				return true;
			}
			if ($this->log_data[$this->key]['last_run'] + $task['period'] > time()) {
				Paint::string(lang('Home.cron.task_locked_by_date', array('%task%' => $this->key)))->fonYellow()->print();
				return false;
			}
			return true;
		}

		protected function runCronTask($cron_task)
		{
			try {
				$this->log_data[$this->key]['result'] =
					call_user_func_array(array(new $cron_task['class'], $cron_task['method']), $cron_task['arguments']);
				$this->log_data[$this->key]['last_run'] = time();
				Paint::string(lang('Home.cron.task_successful_executed', array('%task%' => $this->key)))->fonGreen()->print();
			} catch (\Error $error) {
				$error_key = Errors::saveError(256,
					$error->getMessage(), $error->getFile(), $error->getLine()
				);
				$this->log_data[$this->key]['error_key'][$error_key] = time();
			}
			return $this;
		}

		protected function setLockedStatus(bool $status)
		{
			$this->log_data[$this->key]['locked'] = $status;
			return $this;
		}

		protected function updateData()
		{
			file_put_contents($this->log_file, php_encode($this->log_data));
			return $this;
		}
	}