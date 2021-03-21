<?php

	namespace Core\Interfaces\Database;

	interface Table
	{
		/**
		 * @param array ...$fields
		 * @return Select
		 */
		public function select(...$fields);

		/**
		 * @return boolean
		 */
		public function exists();

		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return Insert
		 */
		public function insert($field, $value, $prepare = true);

		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return MultiInsert
		 */
		public function multiInsert($field, $value, $prepare = true);

		/**
		 * @param $field
		 * @param $value
		 * @param bool $prepare
		 * @return MultiReplace
		 */
		public function multiReplace($field, $value, $prepare = true);

		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return Replace
		 */
		public function replace($field, $value, $prepare = true);

		/**
		 * @param $field
		 * @param $value
		 * @param $prepare
		 * @return Update
		 */
		public function update($field, $value, $prepare = true);

		/**
		 * @return Delete
		 */
		public function delete();

		/**
		 * @param array $fields
		 * @param array $indexes
		 * @return Make
		 */
		public function make(array $fields, array $indexes);

		/**
		 * @return Drop
		 */
		public function drop();

		/**
		 * @return Alter
		 */
		public function alter();

		/**
		 * @return Columns
		 */
		public function columns();

		/**
		 * @return Truncate
		 */
		public function truncate();
	}