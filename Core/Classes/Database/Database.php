<?php

	namespace Core\Classes\Database;

	use Core\Classes\Config;
	use Core\Interfaces\Database\Builder;
	use Core\Interfaces\Database\Database as DatabaseInterface;
	use Core\Interfaces\Database\DatabaseGetters;
	use Core\Interfaces\Database\DatabaseSetters;
	use Core\Interfaces\Database\Result;
	use Core\Interfaces\Database\Table;

	class Database implements DatabaseInterface, DatabaseGetters, DatabaseSetters, Table
	{
		use \Core\Traits\Database\DatabaseGetters;
		use \Core\Traits\Database\DatabaseSetters;

		private static $databases = array();
		private static $database_tables = array();

		protected $command;
		protected $table = array();
		protected $query;

		protected $join_types = array();
		protected $join_tables = array();
		protected $join_conditions = array();

		protected $prepare_values = array();
		protected $prepare_types = array();

		protected $fields = array();
		protected $indexes = array();
		protected $insert = array();
		protected $update = array();

		protected $limit = 0;
		protected $offset = 0;
		protected $sort_field;
		protected $sort_type;
		protected $group_fields = array();

		/**
		 * @param $table
		 * @return Table
		 */
		public static function table(...$table)
		{
			$self = new self();
			return $self->setTable($table);
		}

		/** @return Builder */
		public static function getBuilder()
		{
			/** @var Builder $builder */
			$builder = Config::database('db_driver');
			return $builder::getInstance();
		}

		/**
		 * @param $query
		 * @return DatabaseInterface
		 */
		public static function sql($query)
		{
			$self = new self();
			return $self->setQuery($query)->setCommand('sql');
		}

		public static function makeDb($db_name)
		{
			return self::getBuilder()->makeDb($db_name);
		}

		public static function dropDb($db_name)
		{
			return self::getBuilder()->dropDb($db_name);
		}

		public static function showDB()
		{
			return self::getBuilder()->showDB();
		}

		public static function useDB($database)
		{
			return self::getBuilder()->selectDB($database);
		}

		public static function showTables($database)
		{
			return self::getBuilder()->showTables($database);
		}

		/**
		 * @begin Для запросов с неявно указанной таблицей.
		 * @begin Хоть зпрос можно и кешировать, но все же:
		 * @begin зачем нам 4 одинаковых запроса на странице
		 * @begin если выключен кеш (риторический вопрос)
		 * @return array
		 */
		public static function getDatabases()
		{
			if (!self::$databases) {
				self::$databases = self::showDB();
			}
			return self::$databases;
		}

		public static function getTables($db_name = null)
		{
			if (!isset(self::$database_tables[$db_name])) {
				self::$database_tables[$db_name] = self::showTables($db_name);
			}
			return self::$database_tables[$db_name];
		}

		/**
		 * @end Для запросов с неявно указанной таблицей.
		 * @end Хоть зпрос можно и кешировать, но все же:
		 * @end зачем нам 4 одинаковых запроса на странице
		 * @end если выключен кеш (риторический вопрос)
		 * @param null $db_name
		 * @return bool
		 */
		public static function dbExists($db_name = null)
		{
			return in_array($db_name, self::getDatabases());
		}

		public function exists()
		{
			$tables = self::getTables(Config::database('db_name'));
			$exists = false;
			if ($tables) {
				$exists = true;
				foreach ($this->table as $table) {
					if (!in_array($table, $tables)) {
						$exists = false;
						break;
					}
				}
			}
			return $exists;
		}

		public function limit($limit, $offset = 0)
		{
			return $this->setLimit($limit)->setOffset($offset);
		}

		public function sort($field, $type = 'ASC')
		{
			return $this->setSortField($field)
				->setSortType($type);
		}

		public function group(...$fields)
		{
			return $this->setGrouping($fields);
		}

		public function join($table, $condition, $type = 'LEFT ')
		{
			return $this->setJoinTables($table)
				->setJoinConditions($condition)
				->setJoinTypes($type);
		}

		public function query($condition)
		{
			return $this->setQuery($condition);
		}

		public function select(...$fields)
		{
			return $this->setCommand(__FUNCTION__)
				->setFields($fields);
		}

		public function insert($field, $value, $prepare = true)
		{
			if ($prepare) {
				return $this->prepare(":{$field}", $value)
					->setCommand(__FUNCTION__)
					->setInsert($field, ":{$field}");
			}
			return $this->setCommand(__FUNCTION__)
				->setInsert($field, $value);
		}

		public function multiReplace($field, $value, $prepare = true)
		{
			if ($prepare) {
				return $this->multiPrepare(":{$field}", $value)
					->setCommand(__FUNCTION__)
					->setMultiInsert($field, ":{$field}");
			}
			return $this->setCommand(__FUNCTION__)
				->setMultiInsert($field, $value);
		}

		public function multiInsert($field, $value, $prepare = true)
		{
			if ($prepare) {
				return $this->multiPrepare(":{$field}", $value)
					->setCommand(__FUNCTION__)
					->setMultiInsert($field, ":{$field}");
			}
			return $this->setCommand(__FUNCTION__)
				->setMultiInsert($field, $value);
		}

		public function multiPrepare($key, $value, $type = 'string')
		{
			return $this->setMultiPrepareValues($key, $value)
				->setMultiPrepareTypes($key, $type);
		}

		public function orUpdate($field, $value, $prepare = true)
		{
			if ($prepare) {
				return $this->prepare(":{$field}", $value)
					->setUpdate($field, ":{$field}");
			}
			return $this->setUpdate($field, $value);
		}

		public function replace($field, $value, $prepare = true)
		{
			if ($prepare) {
				return $this->prepare(":{$field}", $value)
					->setCommand(__FUNCTION__)
					->setInsert($field, ":{$field}");
			}
			return $this->setCommand(__FUNCTION__)
				->setInsert($field, $value);
		}

		public function update($field, $value, $prepare = true)
		{
			if ($prepare) {
				return $this->prepare(":{$field}", $value)
					->setCommand(__FUNCTION__)
					->setUpdate($field, ":{$field}");
			}
			return $this->setCommand(__FUNCTION__)
				->setUpdate($field, $value);
		}

		public function delete()
		{
			return $this->setCommand(__FUNCTION__);
		}

		public function make(array $fields, array $indexes)
		{
			return $this->setCommand(__FUNCTION__)
				->setFields($fields)
				->setIndexes($indexes);
		}

		public function drop()
		{
			return $this->setCommand(__FUNCTION__);
		}

		public function alter()
		{
			return $this->setCommand(__FUNCTION__);
		}

		public function truncate()
		{
			return $this->setCommand(__FUNCTION__);
		}

		public function columns()
		{
			return $this->setCommand(__FUNCTION__);
		}

		public function prepare($key, $value, $type = 'string')
		{
			return $this->setPrepareValues($key, $value)
				->setPrepareTypes($key, $type);
		}

		/**
		 * @return Result
		 */
		public function exec()
		{
			$result = self::getBuilder()->execute($this);
			$this->free();
			return $result;
//			return self::getBuilder()->execute($this);	// change self::free() to `public` access before
		}

		protected function free()
		{
			$this->join_types = array();
			$this->join_tables = array();
			$this->join_conditions = array();
			$this->prepare_values = array();
			$this->prepare_types = array();
			$this->fields = array();
			$this->indexes = array();
			$this->insert = array();
			$this->update = array();
			$this->limit = 1;
			$this->offset = 0;
			$this->sort_field = null;
			$this->sort_type = null;
			$this->group_fields = array();
			$this->query = null;
			return $this;
		}
	}