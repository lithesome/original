<?php

	namespace Core\Interfaces\Database;

	interface Database
	{
//		public function limit($limit);
//		public function offset($offset);
//		public function sort($field, $type);
//		public function join($table, $condition, $type = 'LEFT');
//		public function query($condition);
//		public function select(...$fields);
//		public function insert($field, $value);
//		public function replace($field, $value);
//		public function update($field, $value);
//		public function delete();
//		public function make(array $fields, array $indexes);
//		public function drop();
//		public function alter();
//		public function columns();

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