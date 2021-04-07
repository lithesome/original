<?php

	namespace Controllers\Home\Console\Help;

	use Core\Classes\Console\Console;
	use Core\Classes\Console\Paint\Bootstrap;
	use Core\Classes\Console\Paint\Paint;

	class Help
	{
		protected $commands = array();

		protected $params_methods = array(
			'--pretty' => 'prettyPrint',
			'-p' => 'prettyPrint',
		);

		private $last_cmd = '';

		public function __construct()
		{
			$this->commands = Console::getCommandsRawList();
		}

		public function execute($param = null)
		{
			$param_method = isset($this->params_methods[$param]) ? $this->params_methods[$param] : 'simplePrint';
			foreach ($this->commands as $command) {
				if(!$command['example']){ continue; }
				$this->printLastCmd($command['command']);
				/** @method prettyPrint | simplePrint */
				$this->{$param_method}($command);
			}
			return $this;
		}

		public function runCommandHelp($input_command, $params = null)
		{
			foreach ($this->commands as $command) {
				if(!$command['example']){ continue; }
				$segments = $this->getCmdSegments($command['command']);
				if (isset($segments[0]) && equal($input_command, $segments[0])) {
					$param_method = isset($this->params_methods[$params]) ? $this->params_methods[$params] : 'simplePrint';
					/** @method prettyPrint | simplePrint */
					$this->{$param_method}($command);
				}
			}
			return $this;
		}

		protected function prettyPrint($command)
		{
			Paint::string(CLI)->colorLightGreen()->print("\tphp ", ' ');
			Paint::string($command['command'])->colorYellow()->print(null, ' - ');
			Paint::string(lang($command['description']))->print(null, null);
			$this->printExample($command['example']);
			Paint::string('')->print();
			return $this;
		}

		protected function simplePrint($command)
		{
			Paint::string(CLI)->colorLightGreen()->print("\tphp ", ' ');
			Paint::string($command['command'])->colorYellow()->print(null, ' - ');
			Paint::string(lang($command['description']))->print();
			return $this;
		}

		protected function printLastCmd($cmd)
		{
			$segments = $this->getCmdSegments($cmd);
			if (isset($segments[0])) {
				if (equal($segments[0], $this->last_cmd)) {
					return $this;
				}
				$this->last_cmd = $segments[0];
				Bootstrap::danger(strtoupper($segments[0]), null, PHP_EOL);
			}
			return $this;
		}

		protected function getCmdSegments($cmd)
		{
			preg_match("#[a-z]+#i", $cmd, $segments);
			return $segments;
		}

		protected function printExample(array $examples)
		{
			foreach ($examples as $example) {
				Paint::string(lang('Home.cli.command_example'))->fonBlue()->print(PHP_EOL . "\t\t", ": ");
				Paint::string($example)->colorLightGreen()->print('php ' . CLI . ' ', null);
			}
			return $this;
		}
	}