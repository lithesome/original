<?php

	namespace Controllers\Home\Console\Database;

	use Controllers\Home\Config;
	use Core\Classes\Console\Paint\Paint;
	use Core\Classes\Database\Database;

	class DB
	{
		public function __construct()
		{
		}

		public function make($db_name = false)
		{
			$db_name = $db_name ?: Config::database('db_name');
			Database::makeDb($db_name);
			Database::useDB($db_name);
			Paint::string(lang('Home.cli.database_created', array(
				'%database%' => $db_name
			)))->fonGreen()->print();
			return $this;
		}

		public function drop($db_name = false)
		{
			$db_name = $db_name ?: Config::database('db_name');
			Database::dropDb($db_name);
			Paint::string(lang('Home.cli.database_deleted', array(
				'%database%' => $db_name
			)))->fonGreen()->print();
			return $this;
		}
	}