<?php

	namespace Controllers\Home\Console\Make;

	class Hook extends Make
	{
		protected $target_template = 'Controllers/Home/Console/templates/components/controller/SimpleHook.php';

		public function __construct()
		{
			parent::__construct();
		}

		protected function setTargetParams()
		{
			$this->targets_dir_path = get_root_path("Controllers/" . $this->controller . "/Hooks");
			$this->target_file = $this->targets_dir_path . '/' . $this->target . '.php';
			return $this;
		}

		protected function replaceContent()
		{
			$this->target_content = str_replace(array(
				'SimpleHook', '__controller_ns__',
			), array(
				$this->target, $this->controller,
			), $this->target_content);
			return $this;
		}
	}