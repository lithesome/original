<?php

	namespace Core\Classes\Database\Drivers;

	use Core\Classes\stdClass;

	class __db_driver__
	{
		protected $connect;

		protected $statement;

		protected $result;

		private static $connection;

		/**
		 * Создать соединение если нету, или если $new_connection = false
		 * Венуть self::$connection
		 *
		 * @param bool $new_connection
		 * @return mixed
		 */
		public static function connect($new_connection = false)
		{
			if (self::$connection === null || $new_connection) {
				// self::$connection = new connection();
			}
			return self::$connection;
		}

		/**
		 * Установить соединение в защищенное не-статическое свойство $this->connect = self::connect($new_connection);
		 * Выбрать Базу Данных из Config::database('db_name')
		 * Установить кодировку Базы Данных
		 * Первичная настройка Базы Данных
		 * __db_driver__ constructor.
		 * @param bool $new_connection
		 */
		public function __construct($new_connection = false)
		{

		}

		/**
		 * Закрыть соединение с Базой Данных
		 */
		public function __destruct()
		{

		}

		/**
		 * Выбрать Базу Данных
		 * Вернуть себя
		 * @param $database_name
		 * @return $this
		 */
		public function selectDB($database_name)
		{
			return $this;
		}

		/**
		 * Установить кодировку БД по-умолчанию
		 * Вернуть себя
		 * @param $charset
		 * @return $this
		 */
		protected function setCharset($charset)
		{
			return $this;
		}

		/**
		 * Установить в защищенное не-статическое свойство $this->query = $query
		 * Выполнить запрос
		 * Установить результат выполнения в защищенное не-статическое свойство $this->result
		 * Вернуть себя
		 * @param $query
		 * @return $this
		 */
		public function query($query)
		{
			return $this;
		}

		/**
		 * Установить в защищенное не-статическое свойство $this->query = $query
		 * Подготовить запрос препарированными данными
		 * Выполнить запрос
		 * Установить результат выполнения в защищенное не-статическое свойство $this->result
		 * Вернуть себя
		 * @param $query
		 * @param array $preparing
		 * @param array $types
		 * @return $this
		 */
		public function prepare($query, $preparing = array(), $types = array())
		{
			return $this;
		}

		/**
		 * @deprecated нигде не используется, значит не нужен
		 * Вернуть строку подготовленного запроса (для отладки; для кеша; т.д.)
		 * @param $query
		 * @return string
		 */
		public function getQuery($query)
		{
			return $query;
		}

		/**
		 * Вернуть защищенное не-статическое свойство $this->connect с экземпляром установленного соединения БД
		 * @return object
		 */
		public function getConnect()
		{
			return $this->connect;
		}

		/**
		 * Возвращает результат выполнения запроса к БД
		 * Вернуть защищенное не-статическое свойство $this->result
		 * @return object
		 */
		public function getResult()
		{
			return $this->result;
		}

		/**
		 * Вернуть защищенное не-статическое свойство $this->statement
		 * @return object
		 */
		public function getStatement()
		{
			return $this->statement;
		}

		/**
		 * Вернуть многомерный не-ассоциативный массив результата запроса SELECT
		 * Если $associative = true - вернуть массив
		 * Если $associative != true - вернуть экземпляр класса Core\Classes\stdClass
		 * @param bool $associative
		 * @return array|stdClass
		 */
		public function all($associative = true)
		{
			$data = array();
			return $data ? $data : ($associative ? array() : new stdClass());
		}

		/**
		 * Вернуть одномерный ассоциативный массив результата запроса SELECT
		 * Если $associative = true - вернуть массив
		 * Если $associative != true - вернуть экземпляр класса Core\Classes\stdClass
		 * @param bool $associative
		 * @return array|stdClass
		 */
		public function one($associative = true)
		{
			$result = array();
			return $result ? $result : ($associative ? array() : new stdClass());
		}

		/**
		 * Вернуть целое цисло - количество затронутых строк при выполнении запроса UPDATE|DELETE
		 * @return integer
		 */
		public function rows()
		{

		}

		/**
		 * Вернуть целое число - последний AUTOINCREMENT таблицы при выполнении запроса INSERT
		 * @return integer
		 */
		public function id()
		{

		}
	}