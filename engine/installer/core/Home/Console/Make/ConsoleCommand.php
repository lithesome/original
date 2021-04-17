<?php

	namespace Controllers\Home\Console\Make;

	class ConsoleCommand extends Make
	{
		protected $target_template = 'Controllers/Home/Console/templates/components/controller/SimpleCommand.php';
		protected $command_dir = '';
		protected $command_ns = '';

		public function __construct()
		{
			parent::__construct();
		}

		public function execute($controller, $target)
		{
			if (strpos($target, '/') !== false) {
				$params = explode('/', $target);
				$target = end($params);

				array_pop($params);

				$this->command_dir = DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $params);
				$this->command_ns = '\\' . implode('\\', $params);
			}
			return parent::execute($controller, $target);
		}

		protected function setTargetParams()
		{
			$this->targets_dir_path = get_root_path("Controllers/" . $this->controller . "/Console" . $this->command_dir);
			$this->target_file = $this->targets_dir_path . '/' . $this->target . '.php';
			return $this;
		}

		protected function replaceContent()
		{
			$this->target_content = str_replace(array(
				'SimpleCommand', 'Controllers\\__controller_ns__\\Console', '__controller_ns__',
			), array(
				$this->target, 'Controllers\\__controller_ns__\\Console' . $this->command_ns, $this->controller,
			), $this->target_content);
			return $this;
		}
	}