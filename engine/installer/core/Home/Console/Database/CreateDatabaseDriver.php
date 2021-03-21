<?php

	namespace Controllers\Home\Console\Database;

	use Core\Classes\Console\Paint\Bootstrap;

	class CreateDatabaseDriver
	{
		protected $driver_name;

		protected $driver_file = 'Controllers/Home/Console/templates/database/__db_driver__.php';
		protected $builder_file = 'Controllers/Home/Console/templates/database/__db_builder__.php';

		protected $driver_path_save = 'Core/Classes/Database/Drivers';
		protected $builder_path_save = 'Core/Classes/Database/Builder';

		public function __construct()
		{
			$this->driver_file = get_root_path($this->driver_file);
			$this->builder_file = get_root_path($this->builder_file);
			$this->driver_path_save = get_root_path($this->driver_path_save);
			$this->builder_path_save = get_root_path($this->builder_path_save);
		}

		public function execute($driver_class_name)
		{
			$this->driver_name = $driver_class_name;

			$this->saveDriverClass();
			$this->saveBuilderClass();
			return $this;
		}

		protected function saveDriverClass()
		{
			$content = $this->getFileContent($this->driver_file);
			$content = $this->replaceFileContent($content, array('__db_driver__'), array($this->driver_name));
			$this->saveFileContent($this->driver_path_save . '/' . $this->driver_name . '.php', $content);
			return $this;
		}

		protected function saveBuilderClass()
		{
			$content = $this->getFileContent($this->builder_file);
			$content = $this->replaceFileContent($content, array('__db_builder__', '__db_driver__'), array($this->driver_name, $this->driver_name));
			$this->saveFileContent($this->builder_path_save . '/' . $this->driver_name . '.php', $content);
			return $this;
		}

		protected function getFileContent($file_path)
		{
			return file_get_contents($file_path);
		}

		protected function replaceFileContent($content, array $data_to_replace, array $replaced_data)
		{
			return str_replace($data_to_replace, $replaced_data, $content);
		}

		protected function saveFileContent($file_path, $file_content)
		{
			if (file_exists($file_path)) {
				Bootstrap::warning(lang('Home.cli.file_exists', array(
					'%file%' => $file_path
				)));
				return $this;
			}
			file_put_contents($file_path, $file_content);
			if (file_exists($file_path)) {
				Bootstrap::success(lang('Home.cli.file_created', array(
					'%file%' => $file_path
				)));
			} else {
				Bootstrap::danger(lang('Home.cli.file_not_created', array(
					'%file%' => $file_path
				)));
			}
			return $this;
		}
	}