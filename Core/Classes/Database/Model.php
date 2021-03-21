<?php

	namespace Core\Classes\Database;

	use Core\Classes\Cache\Cache;
	use Core\Interfaces\Database\Table;

	class Model
	{
//		/** @var \Core\Interfaces\Database\Table */
//		public $database;
		/** @var \Core\Interfaces\Cache\Cache */
		protected $cache;

		protected $table;

		public function __construct()
		{
//			$this->database = Database::table($this->table);
			$this->cache = Cache::key($this->table);
		}

		public function setTable($table)
		{
			$this->table = $table;
			return $this;
		}

		public function getTable()
		{
			return $this->table;
		}

		/**
		 * @param $name
		 * @return Table
		 */
		public function __get($name)
		{
			return self::getDatabaseInstance($name);
		}

		/**
		 * @param $name
		 * @param $arguments
		 * @return Table
		 */
		public function __call($name, $arguments)
		{
			return self::getDatabaseInstance($name, $arguments);
		}

		/**
		 * @param $name
		 * @param $arguments
		 * @return Table
		 */
		public static function __callStatic($name, $arguments)
		{
			return self::getDatabaseInstance($name, $arguments);
		}

		private static function getDatabaseInstance($name, $arguments = array())
		{
//			вроде как-бы где-то использовалось...
// 			замена всех нижних подчеркиваний на ` ` (пробел) для,
// 			например SELECT * FROM table simple as s,
// 			где $name = simple_as_s
//			$name = str_replace('_', ' ', $name);
			return Database::table($name, ...$arguments);
		}
	}