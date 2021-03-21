<?php

	namespace Core\Classes\Database\Builder;

	use Core\Classes\Config;
	use Core\Interfaces\Database\DatabaseGetters;
	use Core\Classes\Database\Drivers\MySQLi as MySQLiDriver;

	class MySQLi extends MySQLiDriver
	{
		private static $instance;

		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function execute(DatabaseGetters $database)
		{
			return $this->{$database->getCommand()}($database);
		}

		public function sql(DatabaseGetters $database)
		{
			return $this->prepare($database->getQuery(), $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function makeJoin(DatabaseGetters $database)
		{
			$query = '';
			foreach ($database->getJoinTables() as $index => $table) {
				$query .= " {$database->getJoinTypes()[$index]} JOIN {$table} ON {$database->getJoinConditions()[$index]}";
			}
			return $query;
		}

		protected function makeUpdate(DatabaseGetters $database)
		{
			$query = '';
			foreach ($database->getUpdate() as $field => $value) {
				$query .= "`{$field}`={$value}, ";
			}
			return trim($query, ', ');
		}

		protected function makeTableString(DatabaseGetters $database)
		{
			return implode(',', $database->getTable());
		}

		protected function select(DatabaseGetters $database)
		{
			$query = 'SELECT ';
			$query .= $database->getFields() ? implode(', ', $database->getFields()) : ' * ';
			$query .= " FROM ";
			$query .= $this->makeTableString($database);
			$query .= $database->getJoinTables() ? $this->makeJoin($database) : '';
			$query .= $database->getQuery() ? " WHERE " . $database->getQuery() : '';
			$query .= $database->getGrouping() ? " GROUP BY " . implode(', ', $database->getGrouping()) : '';
			$query .= $database->getSortField() ? " ORDER BY " . $database->getSortField() . " " . $database->getSortType() : '';
			$query .= $database->getLimit() ? " LIMIT " . $database->getOffset() . ", " . $database->getLimit() : '';
			$query .= ";";
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function insert(DatabaseGetters $database)
		{
			$query = 'INSERT INTO ';
			$query .= $this->makeTableString($database);
			$query .= " (`";
			$query .= implode('`, `', array_keys($database->getInsert()));
			$query .= "`";
			$query .= ") VALUES (";
			$query .= implode(', ', array_values($database->getInsert()));
			$query .= ")";
			$query .= $database->getUpdate() ? " ON DUPLICATE KEY UPDATE " . $this->makeUpdate($database) . ';' : ';';
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function replace(DatabaseGetters $database)
		{
			$query = 'REPLACE INTO ';
			$query .= $this->makeTableString($database);
			$query .= " (`";
			$query .= implode('`, `', array_keys($database->getInsert()));
			$query .= "`";
			$query .= ") VALUES (";
			$query .= implode(', ', array_values($database->getInsert()));
			$query .= ")";
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function multiInsert(DatabaseGetters $database)
		{
			$insert_data = $this->prepareMultiData($database);

			$query = 'INSERT INTO ';
			$query .= $this->makeTableString($database);
			$query .= " (`";
			$query .= implode('`, `', $insert_data['fields']);
			$query .= "`";
			$query .= ") VALUES";
			foreach ($insert_data['values'] as $values) {
				$query .= "(" . implode(', ', array_values($values)) . "),";
			}
			$query = trim($query, ',');
			$query .= $database->getUpdate() ? " ON DUPLICATE KEY UPDATE " . $this->makeUpdate($database) . ';' : ';';
			return $this->prepare($query, $insert_data['prepare_values'], $insert_data['prepare_types']);
		}

		protected function multiReplace(DatabaseGetters $database)
		{
			$insert_data = $this->prepareMultiData($database);

			$query = 'REPLACE INTO ';
			$query .= $this->makeTableString($database);
			$query .= " (`";
			$query .= implode('`, `', $insert_data['fields']);
			$query .= "`";
			$query .= ") VALUES";
			foreach ($insert_data['values'] as $values) {
				$query .= "(" . implode(', ', array_values($values)) . "),";
			}
			$query = trim($query, ',') . ';';
			return $this->prepare($query, $insert_data['prepare_values'], $insert_data['prepare_types']);
		}

		private function prepareMultiData(DatabaseGetters $database)
		{
			$prepare_values = $database->getPrepareValues();
			$prepare_types = $database->getPrepareTypes();

			$_fields = array();
			$_values = array();
			$prepared_values = array();
			$prepared_types = array();
			foreach ($database->getInsert() as $field => $values) {
				$_fields[] = $field;
				foreach ($values as $index => $value) {
					if (isset($prepare_values[$value]) && key_exists($index, $prepare_values[$value])) {
						$prepared_values["{$value}_{$index}"] = $prepare_values[$value][$index];
						$prepared_types["{$value}_{$index}"] = $prepare_types[$value][$index];
						$_values[$index][$field] = "{$value}_{$index}";
					}
				}
			}
			$updates = $database->getUpdate();
			if ($updates) {
				foreach ($updates as $field => $data) {
					if (isset($prepare_values[$data])) {
						$prepared_values[$data] = $prepare_values[$data];
						$prepared_types[$data] = $prepare_types[$data];
					}
				}
			}
			return array(
				'fields' => $_fields,
				'values' => $_values,
				'prepare_values' => $prepared_values,
				'prepare_types' => $prepared_types,
			);
		}

		protected function update(DatabaseGetters $database)
		{
			$query = "UPDATE ";
			$query .= $this->makeTableString($database);
			$query .= ' SET ';
			$query .= $this->makeUpdate($database);
			$query .= $database->getQuery() ? " WHERE " . $database->getQuery() : '';
			$query .= $database->getGrouping() ? " GROUP BY " . implode(', ', $database->getGrouping()) : '';
			$query .= $database->getSortField() ? " ORDER BY " . $database->getSortField() . " " . $database->getSortType() : '';
			$query .= $database->getLimit() ? " LIMIT " . $database->getLimit() : '';
			$query .= ";";
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function delete(DatabaseGetters $database)
		{
			$query = "DELETE FROM ";
			$query .= $this->makeTableString($database);
			$query .= $database->getQuery() ? " WHERE " . $database->getQuery() : '';
			$query .= $database->getGrouping() ? " GROUP BY " . implode(', ', $database->getGrouping()) : '';
			$query .= $database->getSortField() ? " ORDER BY " . $database->getSortField() . " " . $database->getSortType() : '';
			$query .= $database->getLimit() ? " LIMIT " . $database->getLimit() : '';
			$query .= ";";
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		public function makeDb($database)
		{
			$query = "CREATE DATABASE IF NOT EXISTS `{$database}`";
			$query .= " DEFAULT CHARSET=" . Config::MySQLi('charset');
			$query .= " COLLATE=" . Config::MySQLi('collate') . ";";
			return $this->query($query);
		}

		public function dropDb($database)
		{
			$query = "DROP DATABASE IF EXISTS `{$database}`;";
			return $this->query($query);
		}

		public function showDB()
		{
			$query = "SHOW DATABASES;";
			/** @var \mysqli_result $databases */
			$databases = $this->query($query)->getResult();
			$result = array();
			if ($databases) {
				while ($row = $databases->fetch_assoc()) {
					$result[] = $row['Database'];
				}
			}
			return $result;
		}

		protected function make(DatabaseGetters $database)
		{
			$query = "CREATE TABLE IF NOT EXISTS ";
			$query .= $this->makeTableString($database);
			$query .= "(";
			foreach ($database->getFields() as $name => $value) {
				$query .= "`{$name}` {$value}, ";
			}
			$indexes_str = '';
			foreach ($database->getIndexes() as $index_name => $index_value) {
				if (!$index_value) {
					continue;
				}
				$indexes_str .= "{$index_value} `{$index_name}` (`{$index_name}`),";
			}
			$query .= trim($indexes_str, ', ');
			$query .= ")";
			$query .= " ENGINE = " . Config::MySQLi('engine') . ", ";
			$query .= " CHARACTER SET " . Config::MySQLi('charset');
			$query .= " COLLATE " . Config::MySQLi('collate') . ";";
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function drop(DatabaseGetters $database)
		{
			$query = "DROP TABLE IF EXISTS ";
			$query .= $this->makeTableString($database);
			$query .= ";";
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function alter(DatabaseGetters $database)
		{
			$query = "ALTER TABLE ";
			$query .= $this->makeTableString($database);
			$query .= " " . $database->getQuery();
			$query .= ";";
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function truncate(DatabaseGetters $database)
		{
			$query = "TRUNCATE TABLE ";
			$query .= $this->makeTableString($database);
			$query .= ";";
			return $this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
		}

		protected function columns(DatabaseGetters $database)
		{
			$query = "SHOW COLUMNS FROM ";
			$query .= $this->makeTableString($database);
			$query .= ";";
			$this->prepare($query, $database->getPrepareValues(), $database->getPrepareTypes());
			$columns = array();
			if ($this->result) {
				while ($row = $this->result->fetch_assoc()) {
					$columns[$row['Field']] = array(
						'type' => $row['Type'],
						'null' => $row['Null'],
						'key' => $row['Key'],
						'default' => $row['Default'],
						'extra' => $row['Extra'],
					);
				}
				$this->result->free_result();
			}
			return $columns;
		}

		public function showTables($database)
		{
			$query = "SHOW TABLES FROM `{$database}`;";
			/** @var \mysqli_result $tables */
			$tables = $this->prepare($query)->getResult();
			$result = array();
			if ($tables) {
				while ($row = $tables->fetch_assoc()) {
					$result[] = $row['Tables_in_' . $database];
				}
			}
			return $result;
		}
	}