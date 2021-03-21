<?php

	namespace Core\Interfaces\Database;

	interface MultiReplace
	{
		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return self
		 */
		public function multiReplace($field, $value, $prepare = true);

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