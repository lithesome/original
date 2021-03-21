<?php

	namespace Core\Interfaces\Database;

	interface Delete
	{
		/**
		 * @param $limit
		 * @return self
		 */
		public function limit($limit);

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
		 * @param $table
		 * @param $condition
		 * @param string $type
		 * @return self
		 */
		public function join($table, $condition, $type = 'LEFT ');

		/**
		 * @param $condition
		 * @return self
		 */
		public function query($condition);

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