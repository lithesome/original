<?php

	namespace Core\Interfaces\Cache;

	interface Setters
	{
		public function setTtl($value);

		public function setKey($value);
	}