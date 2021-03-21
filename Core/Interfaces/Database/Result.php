<?php

	namespace Core\Interfaces\Database;

	interface Result
	{
		/**
		 * @return \mysqli_result
		 */
		public function getResult();

		/**
		 * @return \mysqli_stmt
		 */
		public function getStatement();

		/**
		 * @return \mysqli
		 */
		public function getConnect();

		/**
		 * @param $associative
		 * @return array
		 */
		public function all($associative = true);

		/**
		 * @param bool $associative
		 * @return array|object
		 */
		public function one($associative = true);

		/**
		 * @return string
		 */
		public function rows();

		/**
		 * @return string
		 */
		public function id();
	}