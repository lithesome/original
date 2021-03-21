<?php

	namespace Core\Classes\Console;

	use Core\Interfaces\Console\Maker as MakerInterface;

	class Maker implements MakerInterface
	{
		private $scope = array(
			'controller' => '',
			'method' => 'execute',
			'pattern' => '',
			'mask' => '([a-z0-9\-\_]+)',
			'modifier' => 'i',
			'command' => '',
			'example' => array(),
			'description' => 'Home.cli.simple_console_command',
		);

		public static function register($pattern)
		{
			return new self($pattern);
		}

		public function addCommand()
		{
			return Console::addCommand($this->scope);
		}

		public function __construct($pattern)
		{
			$this->pattern($pattern);
			$this->command($pattern);
		}

		public function controller($value)
		{
			$this->scope['controller'] = $value;
			return $this;
		}

		public function method($value)
		{
			$this->scope['method'] = $value;
			return $this;
		}

		public function pattern($value)
		{
			$this->scope['pattern'] = $value;
			return $this;
		}

		public function mask($value)
		{
			$this->scope['mask'] = $value;
			return $this;
		}

		public function modifier($value)
		{
			$this->scope['modifier'] = $value;
			return $this;
		}

		public function command($value)
		{
			$this->scope['command'] = $value;
			return $this;
		}

		public function example($value)
		{
			$this->scope['example'][] = $value;
			return $this;
		}

		public function description($value)
		{
			$this->scope['description'] = $value;
			return $this;
		}

		public function getCommand()
		{
			return $this->scope;
		}
	}