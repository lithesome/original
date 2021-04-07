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

	date_default_timezone_set('Europe/London');

	include_once get_root_path('vendor/autoload.php');
	include_once get_root_path('Core/Autoload.php');

	\Core\Autoload::loadHelpers();

	spl_autoload_register("\\Core\\Autoload::loadClass");

	setlocale(LC_ALL, Config::core('site_locale'));
	set_error_handler("Core\\Classes\\Errors::except");
	register_shutdown_function('Core\\Classes\\Errors::shutDown');

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