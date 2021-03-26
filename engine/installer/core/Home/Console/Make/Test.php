<?php

	namespace Controllers\Home\Console\Make;

	class Test extends Make
	{
		protected $target_template = 'Controllers/Home/Console/templates/__controller__/Test/SimpleTestClass.php';

		public function __construct()
		{
			parent::__construct();
		}

		protected function setTargetParams()
		{
			$this->targets_dir_path = get_root_path("Controllers/" . $this->controller . "/Test");
			$this->target_file = $this->targets_dir_path . '/' . $this->target . '.php';
			return $this;
		}

		protected function replaceContent()
		{
			$this->target_content = str_replace(array(
				'SimpleTestClass', '__controller_ns__',
			), array(
				$this->target, $this->controller,
			), $this->target_content);
			return $this;
		}
	}