<?php

	namespace Core\Interfaces\Cache;

	interface DriverInterface
	{
		/**
		 * @param $value
		 * @return \Core\Interfaces\Cache\Cache
		 */
		public function setKey($value);
	}