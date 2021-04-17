<?php

	namespace Core;

	class Autoload
	{
		private static $aliases = array();

		public static function alias($alias_class, $alias_file)
		{
			self::$aliases[$alias_class] = $alias_file;
		}

		public static function loadClass($class)
		{
			if (!isset(self::$aliases[$class]) || !self::includeAlias(self::$aliases[$class])) {
				return self::prepareClassNameToClassFile($class);
			}
			return true;
		}

		public static function loadHelpers($helpers_dir = 'Helpers')
		{
			foreach (get_files_list(get_root_path($helpers_dir)) as $file) {
				include_once $file;
			}
			return true;
		}

		protected static function includeAlias($class_file)
		{
			$class_file = get_root_path($class_file);
			if (file_exists($class_file)) {
				include_once $class_file;
				return true;
			}
			return false;
		}

		protected static function prepareClassNameToClassFile($class)
		{
			$class_file_path = get_root_path(self::class2Path($class) . '.php');
			if (file_exists($class_file_path)) {
				include_once $class_file_path;
				return true;
			}
			return false;
		}

		public static function class2Path($class)
		{
			return str_replace('\\', DIRECTORY_SEPARATOR, $class);
		}
	}