<?php

	namespace Core\Interfaces\Database;

	interface Insert
	{
		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return self
		 */
		public function insert($field, $value, $prepare = true);

		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return self
		 */
		public function orUpdate($field, $value, $prepare = true);

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