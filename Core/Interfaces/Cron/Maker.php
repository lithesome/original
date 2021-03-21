<?php

	namespace Core\Interfaces\Cron;

	interface Maker
	{
		/**
		 * @param $cron_task_key
		 * @return self
		 */
		public function key($cron_task_key);

		/**
		 * @param $cron_task_class
		 * @return self
		 */
		public function class($cron_task_class);

		/**
		 * @param $cron_task_period
		 * @return self
		 */
		public function period($cron_task_period);

		/**
		 * @param $cron_task_overtime
		 * @return self
		 */
		public function overtime($cron_task_overtime);

		/**
		 * @param $cron_task_method
		 * @return self
		 */
		public function method($cron_task_method);

		/**
		 * @param $cron_task_status
		 * @return self
		 */
		public function status($cron_task_status);

		/**
		 * @param $cron_task_relevance
		 * @return self
		 */
		public function relevance($cron_task_relevance);

		/**
		 * @param $key
		 * @param $value
		 * @return self
		 */
		public function custom($key, $value);

		/**
		 * @param array ...$cron_task_arguments
		 * @return self
		 */
		public function arguments(...$cron_task_arguments);
	}