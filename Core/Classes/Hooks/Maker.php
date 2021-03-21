<?php

	namespace Core\Classes\Hooks;

	use Core\Interfaces\Hooks\Maker as MakerInterface;

	class Maker implements MakerInterface
	{
		protected $scope = array(
			'key' => '',
			'class' => '',
			'method' => 'execute',
			'status' => STATUS_ACTIVE,
			'relevance' => 10000,
			'arguments' => array(),
		);

		public function __construct()
		{
		}

		public function class($hook_class)
		{
			$this->scope['class'] = $hook_class;
			return $this;
		}

		public function method($hook_method)
		{
			$this->scope['method'] = $hook_method;
			return $this;
		}

		public function status($hook_status)
		{
			$this->scope['status'] = $hook_status;
			return $this;
		}

		public function relevance($hook_relevance)
		{
			$this->scope['relevance'] = $hook_relevance;
			return $this;
		}

		public function custom($key, $value)
		{
			$this->scope[$key] = $value;
			return $this;
		}

		public function arguments(...$hook_arguments)
		{
			$this->scope['arguments'] = $hook_arguments;
			return $this;
		}

		public function getHooks(): array
		{
			return $this->scope;
		}
	}