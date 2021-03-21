<?php

	namespace Controllers\Home\Console\Make;

	use Core\Classes\Console\Paint\Paint;

	class Make
	{
		protected $target_template;
		protected $target_content;
		protected $controller;
		protected $target;
		protected $targets_dir_path;
		protected $target_file;

		public function __construct()
		{
		}

		public function execute($controller, $target)
		{
			$this->controller = $controller;
			$this->target = $target;

			$this->setTargetParams();

			if (!$this->checkExistsFile()) {
				return $this;
			}

			$this->setContent()
				->replaceContent();

			make_dir($this->targets_dir_path);

			file_put_contents($this->target_file, $this->target_content);
			return $this->checkOperationStatus();
		}

		protected function setTargetParams()
		{
			$this->targets_dir_path = get_root_path("Controllers/" . $this->controller);
			$this->target_file = $this->targets_dir_path . '/' . $this->target . '.php';
			return $this;
		}

		protected function checkExistsFile()
		{
			if (file_exists($this->target_file)) {
				Paint::string(lang('Home.cli.file_exists', array(
					'%file%' => $this->target_file
				)))->fonCyan()->print();
				return false;
			}
			return true;
		}

		protected function setContent()
		{
			$this->target_template = get_root_path($this->target_template);
			$this->target_content = file_get_contents($this->target_template);
			return $this;
		}

		protected function replaceContent()
		{
			return $this;
		}

		protected function checkOperationStatus()
		{
			if (file_exists($this->target_file)) {
				return Paint::string(lang('Home.cli.file_created', array(
					'%file%' => $this->target_file
				)))->fonGreen()->print();
			}
			return Paint::string(lang('Home.cli.file_not_created', array(
				'%file%' => $this->target_file
			)))->fonRed()->print();
		}
	}