<?php

	namespace Controllers\Home\Console\Make;

	class Widget extends Make
	{
		protected $target_template = 'Controllers/Home/Console/templates/components/controller/SimpleWidget.php';

		public function __construct()
		{
			parent::__construct();
		}

		public function execute($controller, $target)
		{
			parent::execute($controller, $target);
			return $this->saveTemplate();
		}

		protected function setTargetParams()
		{
			$this->targets_dir_path = get_root_path("Controllers/" . $this->controller . "/Widgets");
			$this->target_file = $this->targets_dir_path . '/' . $this->target . '.php';
			return $this;
		}

		protected function replaceContent()
		{
			$this->target_content = str_replace(array(
				'SimpleWidget', '__controller_ns__'
			), array(
				$this->target, $this->controller
			), $this->target_content);
			return $this;
		}

		protected function saveTemplate()
		{
			$this->target_template = get_root_path('Controllers/Home/Console/templates/components/theme/widgets/simple_widget.html.php');
			$this->targets_dir_path = get_root_theme('controllers/' . $this->controller . '/widgets');
			$this->target_file = $this->targets_dir_path . '/' . $this->target . '.html.php';

			if (!$this->checkExistsFile()) {
				return $this;
			}

			$this->target_content = file_get_contents($this->target_template);
			$this->target_content = str_replace('__controller_ns__', $this->controller, $this->target_content);

			make_dir($this->targets_dir_path);

			file_put_contents($this->target_file, $this->target_content);
			return $this->checkOperationStatus();
		}
	}