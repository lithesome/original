<?php

	namespace Controllers\Home\Console\Make;

	class Controller extends Basic
	{
		protected $templates_dir = 'Controllers/Home/Console/templates';
		protected $templates_path;
		protected $controller_dir = 'Controllers';
		protected $path_to_save;
		protected $controller;
		protected $actions = array();
		protected $replace_data = array();

		protected $host;

		public function __construct()
		{
			$this->templates_path = get_root_path($this->templates_dir);
			$this->setHost();
		}

		protected function setHost()
		{
			if (isset($_SERVER['PWD'])) {
				preg_match_all("#([a-zа-я0-9-_]+)\.([a-zа-я0-9-_]+)#", $_SERVER['PWD'], $matches);
				if (isset($matches[0])) {
					$this->host = 'http://' . end($matches[0]);
				}
			}
			return $this;
		}

		public function execute($controllers_name, ...$controller_actions)
		{
			$this->controller = $controllers_name;
			$this->actions = $controller_actions;
			$this->path_to_save = get_root_path("{$this->controller_dir}/{$this->controller}");

			$this->replace_data = array(
				array('__controller_ns__', '__controller_c__', '__host__'),
				array($this->controller, strtolower($this->controller), $this->host)
			);

			$this->getTemplatesFiles($this->templates_path . '/__controller__', $this->path_to_save);
			if ($this->actions) {
				$this->createActions();
			}

			$theme = new Theme();
			$theme->execute($controllers_name, ...$controller_actions);
		}

		protected function getTemplatesFiles($templates_path, $path_to_save)
		{
			$this->createDirectory($path_to_save);

			foreach (scandir($templates_path) as $file) {
				if ($file == '.' || $file == '..' || $file == 'Actions') {
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
			$this->createDirectory($this->path_to_save . '/Actions/');
			foreach ($this->actions as $action) {
				$this->replace_data = array(
					array('__controller_ns__', '__controller_c__', '__action_ns__', 'SimpleControllerAction', '__action_c__', '__action_ns__', '__host__'),
					array($this->controller, strtolower($this->controller), $action, $action, strtolower($action), 'index', $this->host)
				);

				$this->createFile(
					$this->path_to_save . '/Actions/' . $action . '.php',
					$this->templates_path . '/components/controller/SimpleControllerAction.php',
					...$this->replace_data
				);
			}
			return $this;
		}
	}
