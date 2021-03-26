<?php

	namespace Controllers\Home\Console\Make;

	class Theme extends Basic
	{
		protected $templates_dir = 'Controllers/Home/Console/templates';
		protected $templates_path;
		protected $controller_dir = 'controllers';
		protected $path_to_save;
		protected $controller;
		protected $actions = array();
		protected $replace_data = array();

		public function __construct()
		{
			$this->templates_path = get_root_path($this->templates_dir);
		}

		public function execute($controllers_name, ...$controller_actions)
		{
			$this->controller = $controllers_name;
			$this->actions = $controller_actions;
			$this->path_to_save = get_root_theme("{$this->controller_dir}/{$this->controller}");

			$this->replace_data = array(
				array('__controller_ns__', '__controller_c__', '__action_ns__', '__action_c__'),
				array($this->controller, strtolower($this->controller), 'index', 'index')
			);

			$this->getTemplatesFiles($this->templates_path . '/__theme__', $this->path_to_save);
			if ($this->actions) {
				$this->createActions();
			}
		}

		protected function getTemplatesFiles($templates_path, $path_to_save)
		{
			$this->createDirectory($path_to_save);

			foreach (scandir($templates_path) as $file) {
				if ($file == '.' || $file == '..') {
					continue;
				}

				$new_templates_path = "{$templates_path}/{$file}";
				$new_path_to_save = "{$path_to_save}/{$file}";

				if (is_dir($new_templates_path)) {
					$this->getTemplatesFiles($new_templates_path, $new_path_to_save);
					continue;
				}
				$this->createFile($new_path_to_save, $new_templates_path, ...$this->replace_data);
			}
			return $this;
		}

		protected function createActions()
		{
			$this->createDirectory($this->path_to_save . '/actions/');
			foreach ($this->actions as $action) {
				$this->replace_data = array(
					array('__controller_ns__', '__controller_c__', '__action_ns__', '__action_c__', '__action_ns__'),
					array($this->controller, strtolower($this->controller), $action, strtolower($action), 'index')
				);

				$this->createFile(
					$this->path_to_save . '/actions/' . $action . '.html.php',
					$this->templates_path . '/__theme__/actions/index.html.php',
					...$this->replace_data
				);
			}
			return $this;
		}
	}