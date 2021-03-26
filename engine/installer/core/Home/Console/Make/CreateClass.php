<?php

	namespace Controllers\Home\Console\Make;

	use Core\Classes\Console\Paint\Bootstrap;

	class CreateClass
	{
		public function __construct()
		{
		}

		public function execute($class)
		{
			$class_path = str_replace('\\', '/', $class);
			$path_info = pathinfo($class_path);

			$class_name = $path_info['basename'];
			$namespace = str_replace('/', '\\', $path_info['dirname']);

			$class_file = $path_info['basename'] . '.php';
			$class_dir = $path_info['dirname'];

			$file_root = get_root_path($class_dir . '/' . $class_file);

			if (file_exists($file_root)) {
				Bootstrap::danger(lang('Home.cli.file_exists', array(
					'%file%' => $file_root
				)));
				return $this;
			}

			make_dir(get_root_path($class_dir));

			$content = $this->getClassContent($namespace, $class_name);

			file_put_contents($file_root, $content);

			Bootstrap::success(lang('Home.cli.file_created', array(
				'%file%' => $file_root
			)));
			return $this;
		}

		protected function getClassContent($namespace, $class_name)
		{
			$class_template_file = get_root_path('Controllers/Home/Console/templates/__class__.php');
			$class_template_content = file_get_contents($class_template_file);
			return str_replace(array(
				'__namespace__', '__class__'
			), array(
				$namespace, $class_name
			), $class_template_content);
		}
	}