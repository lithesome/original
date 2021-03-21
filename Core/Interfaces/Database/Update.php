<?php

	namespace Core\Interfaces\Database;

	interface Update
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
		 * @param $condition
		 * @return self
		 */
		public function query($condition);

		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return self
		 */
		public function update($field, $value, $prepare = true);

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