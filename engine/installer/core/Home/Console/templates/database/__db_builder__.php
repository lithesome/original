<?php

	namespace Core\Classes\Database\Builder;

	use Core\Classes\Database\Drivers\__db_driver__ as __db_driver__Driver;
	use Core\Interfaces\Database\DatabaseGetters;

	class __db_builder__ extends __db_driver__Driver
	{
		private static $instance;

		/**
		 * Вернуть экземпляр соединения с  Базой Данных
		 * @return __db_driver__Driver
		 */
		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Вызывается автоматически из объекта класса \Core\Classes\Database\Database (методами insert, select, update, delete, etc)
		 * @param DatabaseGetters $database
		 * @return mixed
		 */
		public function execute(DatabaseGetters $database)
		{
			return $this->{$database->getCommand()}($database);
		}

		/**
		 * Выполняет подготовленный запрос
		 * @param DatabaseGetters $database
		 * @return $this
		 */
		public function sql(DatabaseGetters $database)
		{
			return $this->prepare($database->getQuery(), $database->getPrepareValues(), $database->getPrepareTypes());
		}

		/**
		 * Выполнить запрос SELECT
		 * @param DatabaseGetters $database
		 */
		protected function select(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос INSERT
		 * @param DatabaseGetters $database
		 */
		protected function insert(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос REPLACE
		 * @param DatabaseGetters $database
		 */
		protected function replace(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить мульти-запрос INSERT (fields) VALUES (one), (two), (three) ... (N)
		 * @param DatabaseGetters $database
		 */
		protected function multiInsert(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить мульти-запрос REPLACE (fields) VALUES (one), (two), (three) ... (N)
		 * @param DatabaseGetters $database
		 */
		protected function multiReplace(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос UPDATE
		 * @param DatabaseGetters $database
		 */
		protected function update(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос DELETE
		 * @param DatabaseGetters $database
		 */
		protected function delete(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос CREATE DATABASE IF NOT EXISTS
		 * @param string $database
		 */
		public function makeDb($database)
		{

		}

		/**
		 * Выполнить запрос DROP DATABASE IF EXISTS
		 * @param string $database
		 */
		public function dropDb($database)
		{

		}

		/**
		 * Выполнить запрос SHOW DATABASES
		 */
		public function showDB()
		{

		}

		/**
		 * Выполнить запрос CREATE TABLE IF NOT EXISTS
		 * @param DatabaseGetters $database
		 */
		protected function make(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос DROP TABLE IF EXISTS
		 * @param DatabaseGetters $database
		 */
		protected function drop(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос ALTER TABLE
		 * @param DatabaseGetters $database
		 */
		protected function alter(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос TRUNCATE TABLE
		 * @param DatabaseGetters $database
		 */
		protected function truncate(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос SHOW COLUMNS
		 * @param DatabaseGetters $database
		 */
		protected function columns(DatabaseGetters $database)
		{

		}

		/**
		 * Выполнить запрос SHOW TABLES FROM
		 * @param string $database
		 */
		public function showTables($database)
		{

		}
	}