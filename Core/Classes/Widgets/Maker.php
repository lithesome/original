<?php

	namespace Core\Classes\Widgets;

	use Core\Interfaces\Widgets\Maker as MakerInterface;

	class Maker implements MakerInterface
	{
		protected $scope = array(
			'key' => '',
			'class' => '',
			'title' => 'Home.widget.simple_widget_name',
			'method' => 'execute',
			'status' => STATUS_ACTIVE,
			'content' => array(),
			'options' => array(),
			'position' => 'top',
			'template' => 'simple',
			'relevance' => 10000,
			'arguments' => array(),
		);

		public function __construct()
		{
		}

		public function key($value)
		{
			$this->scope['key'] = $value;
			return $this;
		}

		public function title($value)
		{
			$this->scope['title'] = $value;
			return $this;
		}

		public function class($value)
		{
			$this->scope['class'] = $value;
			return $this;
		}

		public function method($value)
		{
			$this->scope['method'] = $value;
			return $this;
		}

		public function position($value)
		{
			$this->scope['position'] = $value;
			return $this;
		}

		public function template($value)
		{
			$this->scope['template'] = $value;
			return $this;
		}

		public function relevance($value)
		{
			$this->scope['relevance'] = $value;
			return $this;
		}

		public function status($value)
		{
			$this->scope['status'] = $value;
			return $this;
		}

		public function arguments(array $value)
		{
			$this->scope['arguments'] = $value;
			return $this;
		}

		public function options(array $value)
		{
			$this->scope['options'] = $value;
			return $this;
		}

		public function option($key, $value)
		{
			$this->scope['options'][$key] = $value;
			return $this;
		}

		public function custom($key, $value)
		{
			$this->scope[$key] = $value;
			return $this;
		}

		public function getWidget(): array
		{
			return $this->scope;
		}
	}