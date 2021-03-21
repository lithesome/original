<?php

	namespace Core\Traits\Database;

	trait DatabaseSetters
	{
		public function setCommand($command)
		{
			$this->command = $command;
			return $this;
		}

		public function setTable($table)
		{
			$this->table = $table;
			return $this;
		}

		public function setJoinTypes($join_type)
		{
			$this->join_types[] = $join_type;
			return $this;
		}

		public function setJoinTables($join_table)
		{
			$this->join_tables[] = $join_table;
			return $this;
		}

		public function setJoinConditions($join_condition)
		{
			$this->join_conditions[] = $join_condition;
			return $this;
		}

		public function setPrepareValues($key, $prepare_value)
		{
			$this->prepare_values[$key] = $prepare_value;
			return $this;
		}

		public function setPrepareTypes($key, $prepare_type)
		{
			$this->prepare_types[$key] = $prepare_type;
			return $this;
		}

		public function setMultiPrepareValues($key, $prepare_value)
		{
			$this->prepare_values[$key][] = $prepare_value;
			return $this;
		}

		public function setMultiPrepareTypes($key, $prepare_type)
		{
			$this->prepare_types[$key][] = $prepare_type;
			return $this;
		}

		public function setMultiInsert($field, $insert)
		{
			$this->insert[$field][] = $insert;
			return $this;
		}

		public function setFields(array $fields)
		{
			$this->fields = $fields;
			return $this;
		}

		public function setIndexes(array $indexes)
		{
			$this->indexes = $indexes;
			return $this;
		}

		public function setQuery($query)
		{
			$this->query = $query;
			return $this;
		}

		public function setInsert($field, $insert)
		{
			$this->insert[$field] = $insert;
			return $this;
		}

		public function setUpdate($field, $update)
		{
			$this->update[$field] = $update;
			return $this;
		}

		public function setLimit($limit)
		{
			$this->limit = $limit;
			return $this;
		}

		public function setOffset($offset)
		{
			$this->offset = $offset;
			return $this;
		}

		public function setSortType($sort_type)
		{
			$this->sort_type = $sort_type;
			return $this;
		}

		public function setSortField($sort_field)
		{
			$this->sort_field = $sort_field;
			return $this;
		}

		public function setGrouping($group_fields)
		{
			$this->group_fields = $group_fields;
			return $this;
		}
	}