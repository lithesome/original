<?php

	namespace Core\Interfaces\Database;

	interface MultiInsert
	{
		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return self
		 */
		public function multiInsert($field, $value, $prepare = true);

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
		public function multiPrepare($key, $value, $type = 'string');

		/**
		 * @return Result
		 */
		public function exec();
	}