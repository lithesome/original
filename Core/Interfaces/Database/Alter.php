<?php

	namespace Core\Interfaces\Database;

	interface Alter
	{
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