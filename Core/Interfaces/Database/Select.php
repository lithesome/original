<?php

	namespace Core\Interfaces\Database;

	interface Select
	{
		/**
		 * @param $limit
		 * @param $offset
		 * @return self
		 */
		public function limit($limit, $offset = 0);

		/**
		 * @param $field
		 * @param $type
		 * @return self
		 */
		public function sort($field, $type = 'ASC');

		/**
		 * @param $field
		 * @param string $type
		 * @return self
		 */
		public function group($field, $type = 'ASC');

		/**
		 * @param $condition
		 * @return self
		 */
		public function query($condition);

		/**
		 * @param $table
		 * @param $condition
		 * @param string $type
		 * @return self
		 */
		public function join($table, $condition, $type = 'LEFT ');

		/**
		 * @param $key
		 * @param $value
		 * @param string $type
		 * @return self
		 */
		public function prepare($key, $value, $type = 'string');

		/**
		 * @return Result
		 */
		public function exec();
	}