<?php

	namespace Core\Classes\Cron;

	use Core\Interfaces\Cron\Maker as MakerInterface;

	class Maker implements MakerInterface
	{
		protected $scope = array(
			'key' => '',
			'class' => '',
			'method' => 'execute',
			'period' => 60,
			'overtime' => 600,
			'status' => STATUS_ACTIVE,
			'relevance' => 10000,
			'arguments' => array(),
		);

		public static function register($cron_task_key)
		{
			return new self($cron_task_key);
		}

		public function addTask()
		{
			return Cron::addCronTask($this->scope);
		}

		public function __construct($cron_task_key)
		{
			$this->key($cron_task_key);
		}

		public function key($cron_task_key)
		{
			$this->scope['key'] = $cron_task_key;
			return $this;
		}

		public function class($cron_task_class)
		{
			$this->scope['class'] = $cron_task_class;
			return $this;
		}

		public function period($cron_task_period)
		{
			$this->scope['period'] = $cron_task_period;
			return $this;
		}

		public function overtime($cron_task_overtime)
		{
			$this->scope['overtime'] = $cron_task_overtime;
			return $this;
		}

		public function method($cron_task_method)
		{
			$this->scope['method'] = $cron_task_method;
			return $this;
		}

		public function status($cron_task_status)
		{
			$this->scope['status'] = $cron_task_status;
			return $this;
		}

		public function relevance($cron_task_relevance)
		{
			$this->scope['relevance'] = $cron_task_relevance;
			return $this;
		}

		public function custom($key, $value)
		{
			$this->scope[$key] = $value;
			return $this;
		}

		public function arguments(...$cron_task_arguments)
		{
			$this->scope['arguments'] = $cron_task_arguments;
			return $this;
		}

		public function getCronTasks(): array
		{
			return $this->scope;
		}
	}