<?php

	namespace Controllers\Home\Console\Make;

	use Core\Classes\Console\Paint\Paint;

	class Basic
	{
		protected function createFile($new_path_to_save, $new_templates_path, ...$replace_data)
		{
			if (!file_exists($new_path_to_save)) {
				$content = $this->getFileContent($new_templates_path);
				$replaced_content = $this->replaceData($content, ...$replace_data);
				$this->saveData($new_path_to_save, $replaced_content);
				Paint::string(lang('Home.cli.file_created', array(
					'%file%' => $new_path_to_save
				)))->fonGreen()->print();
				return $this;
			}
			Paint::string(lang('Home.cli.file_exists', array(
				'%file%' => $new_path_to_save
			)))->fonRed()->print();
			return $this;
		}

		protected function createDirectory($directory_path)
		{
			if (!is_dir($directory_path)) {
				make_dir($directory_path);
				Paint::string(lang('Home.cli.directory_created', array(
					'%dir%' => $directory_path
				)))->fonCyan()->print();
				return $this;
			}
			Paint::string(lang('Home.cli.directory_exists', array(
				'%dir%' => $directory_path
			)))->fonYellow()->print();
			return $this;
		}

		protected function getFileContent($file_path)
		{
			return file_get_contents($file_path);
		}

		protected function replaceData($data, $search, $replace)
		{
			return str_replace($search, $replace, $data);
		}

		protected function saveData($path, $data)
		{
			return file_put_contents($path, $data);
		}

	}