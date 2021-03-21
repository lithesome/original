<?php

	use Core\Classes\Config;

	define('MEMORY', memory_get_usage());
	define('TIME', microtime(1));

	define('ROOT', __DIR__);
	define('ROOT_PUBLIC', ROOT . '/public');
	define('HTTP_PUBLIC', '/public');
	define('ROOT_TEMPLATES', ROOT_PUBLIC . '/themes');
	define('HTTP_TEMPLATES', HTTP_PUBLIC . '/themes');

	error_reporting(0);
	ini_set('display_errors', '0');
//	error_reporting(E_ALL);
//	ini_set('display_errors', '1');

	date_default_timezone_set('Europe/London');

	require_once get_root_path('vendor/autoload.php');

	spl_autoload_register(function ($class) {
		$class_file_name = str_replace('\\', DIRECTORY_SEPARATOR, $class);
		$class_file_path = get_root_path($class_file_name . '.php');
		if (file_exists($class_file_path)) {
			include_once $class_file_path;
		}
	});

	setlocale(LC_ALL, Config::core('site_locale'));
	set_error_handler("Core\\Classes\\Errors::except");
	register_shutdown_function('Core\\Classes\\Errors::shutDown');

	foreach (get_files_list(get_root_path('Helpers')) as $file) {
		include_once $file;
	}

	function get_root_path($file)
	{
		$file = ltrim($file, '/');
		return ROOT . '/' . $file;
	}

	function get_dirs_list($dir_path): array
	{
		return glob($dir_path . "/*", GLOB_ONLYDIR);
	}

	function get_files_list($dir_path, $files_extension = ".php"): array
	{
		return glob($dir_path . "/*" . $files_extension);
	}
