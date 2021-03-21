<?php

	namespace Core\Interfaces\Database;

	interface DatabaseGetters
	{
		public function getCommand();

		public function getTable();

		public function getJoinTypes();

		public function getJoinTables();

		public function getJoinConditions();

		public function getPrepareValues();

		public function getPrepareTypes();

		public function getFields();

		public function getIndexes();

		public function getQuery();

		public function getInsert();

		public function getUpdate();

		public function getLimit();

		public function getOffset();

		public function getSortType();

		public function getSortField();

		public function getGrouping();
	}