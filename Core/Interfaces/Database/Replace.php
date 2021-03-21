<?php

	namespace Core\Interfaces\Database;

	interface Replace
	{
		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return self
		 */
		public function replace($field, $value, $prepare = true);

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