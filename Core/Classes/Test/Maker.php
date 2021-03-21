<?php

	namespace Core\Classes\Test;

	use Core\Interfaces\Test\Maker as MakerInterface;

	class Maker implements MakerInterface
	{
		protected $scope = array(
			'class' => '',
			'method' => 'execute',
			'status' => STATUS_ACTIVE,
			'relevance' => 10000,
			'params' => array(),
		);

		public static function register()
		{
			return new self();
		}

		public function addTest()
		{
			return Test::addTest($this->scope);
		}

		public function __construct()
		{
		}

		public function class($class)
		{
			$this->scope['class'] = $class;
			return $this;
		}

		public function method($method)
		{
			$this->scope['method'] = $method;
			return $this;
		}

		public function params(...$params)
		{
			$this->scope['params'] = $params;
			return $this;
		}

		public function status($status)
		{
			$this->scope['status'] = $status;
			return $this;
		}

		public function relevance($relevance)
		{
			$this->scope['relevance'] = $relevance;
			return $this;
		}

		public function getTest()
		{
			return $this->scope;
		}
	}