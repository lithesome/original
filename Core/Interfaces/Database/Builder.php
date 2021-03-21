<?php

	namespace Core\Interfaces\Database;

	interface Builder
	{
		/**
		 * @param bool $new_connection
		 * @return self
		 */
		public static function connect($new_connection = false);

		/**
		 * @param $database_name
		 * @return self
		 */
		public function selectDB($database_name);

		/**
		 * @param $query
		 * @return Result
		 */
		public function query($query);

		/**
		 * @param $query
		 * @param array $preparing
		 * @param array $types
		 * @return Result
		 */
		public function prepare($query, $preparing = array(), $types = array());

		/**
		 * @return self
		 */
		public static function getInstance();

		/**
		 * @param DatabaseGetters $database
		 * @return Result
		 */
		public function execute(DatabaseGetters $database);

		/**
		 * @param DatabaseGetters $database
		 * @return Result
		 */
		public function sql(DatabaseGetters $database);

		/**
		 * @param $database
		 * @return Result
		 */
		public function makeDb($database);

		/**
		 * @param $database
		 * @return Result
		 */
		public function dropDb($database);

		/**
		 * @return array
		 */
		public function showDB();

		/**
		 * @param $database
		 * @return array
		 */
		public function showTables($database);
	}