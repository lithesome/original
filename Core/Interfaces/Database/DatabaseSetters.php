<?php

	namespace Core\Interfaces\Database;

	interface DatabaseSetters
	{
		/**
		 * @param $command
		 * @return self
		 */
		public function setCommand($command);

		/**
		 * @param $table
		 * @return self
		 */
		public function setTable($table);

		/**
		 * @param $join_type
		 * @return self
		 */
		public function setJoinTypes($join_type);

		/**
		 * @param $join_table
		 * @return self
		 */
		public function setJoinTables($join_table);

		/**
		 * @param $join_condition
		 * @return self
		 */
		public function setJoinConditions($join_condition);

		/**
		 * @param $key
		 * @param $prepare_value
		 * @return self
		 */
		public function setPrepareValues($key, $prepare_value);

		/**
		 * @param $key
		 * @param $prepare_type
		 * @return self
		 */
		public function setPrepareTypes($key, $prepare_type);

		/**
		 * @param array $fields
		 * @return self
		 */
		public function setFields(array $fields);

		/**
		 * @param array $indexes
		 * @return self
		 */
		public function setIndexes(array $indexes);

		/**
		 * @param $query
		 * @return self
		 */
		public function setQuery($query);

		/**
		 * @param $field
		 * @param $insert
		 * @return self
		 */
		public function setInsert($field, $insert);

		/**
		 * @param $key
		 * @param $prepare_value
		 * @return self
		 */
		public function setMultiPrepareValues($key, $prepare_value);

		/**
		 * @param $key
		 * @param $prepare_type
		 * @return self
		 */
		public function setMultiPrepareTypes($key, $prepare_type);

		/**
		 * @param $field
		 * @param $insert
		 * @return self
		 */
		public function setMultiInsert($field, $insert);

		/**
		 * @param $field
		 * @param $update
		 * @return self
		 */
		public function setUpdate($field, $update);

		/**
		 * @param $limit
		 * @return self
		 */
		public function setLimit($limit);

		/**
		 * @param $offset
		 * @return self
		 */
		public function setOffset($offset);

		/**
		 * @param $sort_type
		 * @return self
		 */
		public function setSortType($sort_type);

		/**
		 * @param $sort_field
		 * @return self
		 */
		public function setSortField($sort_field);

		/**
		 * @param $group_fields
		 * @return self
		 */
		public function setGrouping($group_fields);
	}