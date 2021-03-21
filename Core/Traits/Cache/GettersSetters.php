<?php

	namespace Core\Traits\Cache;

	trait GettersSetters
	{
		public function getTtl()
		{
			return $this->ttl;
		}

		public function getKey()
		{
			return $this->key;
		}

		public function setTtl($value)
		{
			$this->ttl = $value;
			return $this;
		}

		public function setKey($value)
		{
			$this->key = $value;
			return $this;
		}
	}