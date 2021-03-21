<?php

	namespace Controllers\Home\Console\Test;

	use Controllers\Home\Config;
	use Controllers\Home\Console\Database\DB;
	use Core\Classes\Console\Paint\Bootstrap;
	use Core\Classes\Database\Database;
	use Core\Classes\Test\Test;

	class Run
	{
		protected $test;
		protected $maker;
		protected $temporary_database_prefix = 'TEMPORARY_DATABASE_TEST_';

		private $sys_tables = array(
			'information_schema',
			'mysql',
			'performance_schema',
			'phpmyadmin',
			'sys',
		);

		protected $tests_list = array();

		public function __construct()
		{
			$this->maker = new DB();
			$this->test = new Test();
			$this->tests_list = $this->test->getTestsList();
		}

		public function makeTemporaryDatabase()
		{
			$temporary_data_base = $this->temporary_database_prefix . md5(time());
			Config::database('db_name', $temporary_data_base);
			$this->execute();
			$this->dropTemporaryDatabases();
			return $this;
		}

		public function dropTemporaryDatabases()
		{
			foreach (Database::getDatabases() as $database) {
				if (in_array($database, $this->sys_tables)) {
					continue;
				}
				if (strpos($database, $this->temporary_database_prefix) !== false) {
					$this->maker->drop($database);
				}
			}
			return $this;
		}

		public function execute()
		{
			$this->maker->drop();
			$this->maker->make();

			foreach ($this->tests_list as $test) {
				if (equal($test['status'], STATUS_ACTIVE)) {
					Bootstrap::success(lang('Home.cli.run_test_command', array(
						'%class%' => $test['class'],
						'%method%' => $test['method'],
						'%params%' => implode(', ', $test['params']),
					)), null, null);

					call_user_func_array(array(new $test['class'](...$test['params']), $test['method']), $test['params']);

					Bootstrap::danger(lang('Home.do_ok'));
				} else {
					Bootstrap::purple(lang('Home.cli.cant_run_test_command', array(
						'%class%' => $test['class'],
						'%method%' => $test['method'],
						'%params%' => implode(', ', $test['params']),
					)));
				}
			}
			return $this;
		}
	}