<?php

	namespace Core\Classes\Database\Drivers;

	use Core\Classes\Config;
	use Core\Classes\Errors;
	use Core\Classes\stdClass;
	use mysqli as ParentMysqli;
	use mysqli_result as ResultMysqli;
	use mysqli_stmt as StatementMysqli;
	use Core\Classes\Response\Response;
	use PhpMyAdmin\SqlParser\Utils\Formatter;

	/**
	 * Class MySQLi
	 * @package Core\Classes\Database\Drivers
	 * @TEST safe mode (recommended method)
	 * pre(
	 *        (new \Core\Classes\Database\Drivers\MySQLi)
	 *            ->prepare(
	 *                "select * from users where login=%login%",    // string query
	 *                array('%login%'=>'admin@m.c'),                // array associative params
	 *                array('%login%'=>'string')                    // array associative types
	 *            )
	 *            ->one()
	 * );
	 *
	 * @TEST unsafe mode (protected raw queries) (not recommended method)
	 * pre(
	 *        (new \Core\Classes\Database\Drivers\MySQLi)
	 *            ->query('select * from users where login = \'admin@m.c\'')
	 *            ->one()
	 * );
	 */
	class MySQLi
	{
		protected $query;
		protected $prepared_query;
		protected $result_query;
		protected $bind_types;
		protected $bind_keys = array();
		protected $bind_values = array();

		private $types = array(
			'int' => 'i',
			'integer' => 'i',
			'str' => 's',
			'string' => 's',
			'doub' => 'd',
			'double' => 'd',
			'blob' => 'b',
		);

		/** @var ParentMysqli */
		protected $connect;

		/** @var StatementMysqli */
		protected $statement;

		/** @var ResultMysqli */
		protected $result;

		protected $response;

		private static $connection;

		public static function connect($new_connection = false)
		{
			if (self::$connection === null || $new_connection) {
				$time = microtime(true);
				self::$connection = new ParentMysqli(
					Config::MySQLi('db_host'),
					Config::MySQLi('db_user'),
					Config::MySQLi('db_pass'),
					'',
					Config::MySQLi('db_port')
				);
				Response::getInstance()
					->setDebug('Home.debug.debug_database', $time, "DATABASE CONNECT;");
			}
			return self::$connection;
		}

		public function __construct($new_connection = false)
		{
			$time = microtime(1);
			$this->response = Response::getInstance();
			$this->connect = self::connect($new_connection);

			$this->response->setDebug('Home.debug.debug_database', $time, 'DATABASE INIT;');
			$this->selectDB(Config::database('db_name'));
			$this->setCharset(Config::MySQLi('charset'));
			$this->setDefaultParams();
		}

		public function __destruct()
		{
			$time = microtime(1);
			$this->connect->close();
			$this->response->setDebug('Home.debug.debug_database', $time, 'DATABASE DISCONNECT;');
		}

		public function selectDB($database_name)
		{
			$this->connect->select_db($database_name);
			return $this;
		}

		protected function setCharset($charset)
		{
			$this->connect->set_charset($charset);
			return $this;
		}

		public function query($query)
		{
			$this->free();

			$time = microtime(1);

			$this->query = $query;
			$this->result = $this->connect->query($query);
			$query = Formatter::format($this->query, array('type' => 'plain'));
			if ($this->connect->errno) {
				Errors::except($this->connect->errno, $this->connect->error, __FILE__, __LINE__ - 3, $query);
			}
			$this->response->setDebug('Home.debug.debug_database', $time, $query);
			return $this;
		}

		public function prepare($query, $preparing = array(), $types = array())
		{
			$this->free();
			$time = microtime(1);
			$this->query = $query;
			$this->prepareQuery($preparing, $types);
			$this->statement = $this->connect->prepare($this->query);
			$query = Formatter::format($this->getQuery($query), array('type' => 'plain'));
			if ($this->connect->errno) {
				Errors::except($this->connect->errno, $this->connect->error, __FILE__, __LINE__ - 3, $query);
			}
			if ($this->statement) {
				$this->prepareParams();
				$this->statement->execute();
				if ($this->connect->errno) {
					Errors::except($this->connect->errno, $this->connect->error, __FILE__, __LINE__ - 3, $query);
				}
				$this->result = $this->statement->get_result();
			}
			$this->response->setDebug('Home.debug.debug_database', $time, $query);
			return $this;
		}

		public function getQuery($query)
		{
			return str_replace($this->bind_keys, $this->bind_values, $query);
		}

		private function prepareQuery(array $preparing_data, array $preparing_types)
		{
			if ($preparing_data) {
				$this->query = preg_replace_callback("#:[a-zA-Z0-9_]+#",
					function ($result) use ($preparing_data, $preparing_types) {
						if (isset($result[0]) && key_exists($result[0], $preparing_data)) {
							$this->bind_keys[] = $result[0];
							$this->bind_values[] = $preparing_data[$result[0]];
							$this->bind_types .= isset($this->types[$preparing_types[$result[0]]])
								? $this->types[$preparing_types[$result[0]]] : $preparing_types[$result[0]];
							return '?';
						}
						return $result[0];
					}, $this->query);
			}
			return $this;
		}

		private function prepareParams()
		{
			if ($this->bind_types) {
				$this->statement->bind_param($this->bind_types, ...$this->bind_values);
			}
			return $this;
		}

		private function free()
		{
			$this->query = null;
			$this->bind_types = '';
			$this->bind_keys = array();
			$this->bind_values = array();
			if ($this->statement instanceof StatementMysqli) {
				$this->statement->free_result();
				$this->statement->close();
				$this->statement = null;
			}
			return $this;
		}

		public function getConnect()
		{
			return $this->connect;
		}

		public function getResult()
		{
			return $this->result;
		}

		public function getStatement()
		{
			return $this->statement;
		}

		public function all($associative = true)
		{
			$data = array();
			if ($this->result) {
				while ($row = $associative ? $this->result->fetch_assoc() : $this->result->fetch_object()) {
					$data[] = $row;
				}
				$this->result->free_result();
			}
			return $data ? $data : ($associative ? array() : new stdClass());
		}

		public function one($associative = true)
		{
			$result = array();
			if ($this->result) {
				$result = $associative ? $this->result->fetch_assoc() : $this->result->fetch_object();
				$this->result->free_result();
			}
			return $result ? $result : ($associative ? array() : new stdClass());
		}

		public function rows()
		{
			return $this->connect->affected_rows;
		}

		public function id()
		{
			return $this->connect->insert_id;
		}

		protected function setDefaultParams()
		{
			$query = "SET ";
			$query .= "time_zone = '" . date('P') . "', ";
			$query .= "lc_messages = '" . Config::MySQLi('locale') . "', ";
			$query .= "sql_mode='" . Config::MySQLi('mode') . "', ";
			$query .= "default_storage_engine = " . Config::MySQLi('engine') . ", ";
			$query .= "default_tmp_storage_engine = " . Config::MySQLi('engine') . ";";
			$this->query($query);
			return $this;
		}
	}