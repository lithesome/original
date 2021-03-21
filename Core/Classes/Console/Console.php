<?php

	namespace Core\Classes\Console;

	use Core\Classes\Console\Paint\Paint;

	class Console
	{
		const CACHED_FILE = 'tmp/config/console.php';

		private static $commands_list = array();
		protected $cached_commands_file;

		private $arguments = array();
		private $arguments_string = '';
		private $command = array(
			'class' => '',
			'method' => '',
			'params' => array(),
		);

		public static function register($pattern, callable $callback)
		{
			$command_maker_instance = new Maker($pattern);
			call_user_func($callback, $command_maker_instance);
			$command = $command_maker_instance->getCommand();
			return self::addCommand($command);
		}

		public static function addCommand(array $command)
		{
			self::$commands_list[] = $command;
			return true;
		}

		public static function run(...$commands)
		{
			defined('CLI') ?: define('CLI', 'cli');
			defined('FAKE_CONSOLE') ?: define('FAKE_CONSOLE', true);
			array_unshift($commands, CLI);
			$console = new self($commands);
			$console->searchCommandInCommandsList();
			return $console->runCommand();
		}

		public function __construct(array $arguments_list)
		{
			$this->cached_commands_file = get_root_path(self::CACHED_FILE);

			$this->setArguments($arguments_list);
			$this->setCommands();
			$this->sortCommandsList();
		}

		private function sortCommandsList()
		{
			usort(self::$commands_list, function ($commandA, $commandB) {
				return strcmp($commandA['command'], $commandB['command']);
			});
			return $this;
		}

		private function setCommands()
		{
			if (file_exists($this->cached_commands_file)) {
				self::$commands_list = include $this->cached_commands_file;
				return $this;
			}
			return $this->scanControllersDirs();
		}

		private function scanControllersDirs()
		{
			foreach (get_dirs_list(get_root_path('Controllers')) as $controller) {
				$command_file = $controller . "/assets/console.php";
				if (file_exists($command_file)) {
					include_once $command_file;
				}
			}
			return $this;
		}

		public function setArguments(array $arguments)
		{
			$this->arguments = $arguments;
			$this->arguments_string = trim(implode(' ', array_slice($this->arguments, 1)));
			return $this;
		}

		public function getArguments()
		{
			return $this->arguments;
		}

		public function getArgumentsString()
		{
			return $this->arguments_string;
		}

		public static function getCommandsRawList()
		{
			return self::$commands_list;
		}

		public function searchCommandInCommandsList()
		{
			if (!isset($this->arguments[1])) {
				return $this;
			}
			foreach (self::$commands_list as $command) {
				if ($this->checkCommand($command)) {
					break;
				}
			}
			return $this;
		}

		public function searchAlternativeCommandInCommandsList()
		{
			if (!isset($this->arguments[1])) {
				return $this;
			}
			foreach (self::$commands_list as $command) {
				if ($this->comparePatterns($command)) {
					break;
				}
			}
			return $this;
		}

		private function comparePatterns($command)
		{
			if (equal(strtolower($command['pattern']), strtolower($this->arguments[1]))) {
				return $this->setCommand($command['controller'], $command['method'], array_slice($this->arguments, 2));
			}
			return false;
		}

		private function checkCommand($command)
		{
			$pattern = $this->replacePattern($command['mask'], $command['pattern']);
			preg_match("#{$pattern}#{$command['modifier']}", $this->arguments_string, $params);
			if (isset($params[0]) && $params[0] === $this->arguments_string) {
				return $this->setCommand($command['controller'], $command['method'], array_slice($params, 1));
			}
			return false;
		}

		private function replacePattern($mask, $pattern)
		{
			$pattern = str_replace(array('{integer}', '{string}'), array('([0-9]+)', '([a-z]+)'), $pattern);
			$result = preg_replace("#\{(.*?)\}#", $mask, $pattern);
			return $result;
		}

		public function getCommand()
		{
			return $this->command;
		}

		public function setCommand($class, $method, array $params)
		{
			$this->command['class'] = $class;
			$this->command['method'] = $method;
			$this->command['params'] = $params;
			return $this;
		}

		public function runCommand()
		{
			if (!$this->command['class']) {
				$this->searchAlternativeCommandInCommandsList();
			}
			return $this->executeCommand();
		}

		private function executeCommand()
		{
			if (method_exists($this->command['class'], $this->command['method'])) {
				$command_object = new $this->command['class'];
				return call_user_func_array(array($command_object, $this->command['method']), $this->command['params']);
			}
			Paint::string(lang('Home.cli.command_not_found', array(
				'%command%' => '`php ' . CLI . ' help`'
			)))->fonRed()->print();
			return $this;
		}
	}