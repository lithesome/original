<?php

	namespace Core\Traits\Database;

	trait DatabaseGetters
	{
		public function getCommand()
		{
			return $this->command;
		}

		public function getTable()
		{
			return $this->table;
		}

		public function getJoinTypes()
		{
			return $this->join_types;
		}

		public function getJoinTables()
		{
			return $this->join_tables;
		}

		public function getJoinConditions()
		{
			return $this->join_conditions;
		}

		public function getPrepareValues()
		{
			return $this->prepare_values;
		}

		public function getPrepareTypes()
		{
			return $this->prepare_types;
		}

		public function getFields()
		{
			return $this->fields;
		}

		public function getIndexes()
		{
			return $this->indexes;
		}

		public function getQuery()
		{
			return $this->query;
		}

		public function getInsert()
		{
			return $this->insert;
		}

		public function getUpdate()
		{
			return $this->update;
		}

		public function getLimit()
		{
			return $this->limit;
		}

		public function getOffset()
		{
			return $this->offset;
		}

		public function getSortType()
		{
			return $this->sort_type;
		}

		public function getSortField()
		{
			return $this->sort_field;
		}

		public function getGrouping()
		{
			return $this->group_fields;
		}
	}