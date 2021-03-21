<?php

	namespace Core\Interfaces\Cache;

	interface Cache
	{
		/**
		 * @param $ttl
		 * @return self
		 */
		public function ttl($ttl);

		/**
		 * @param $key
		 * @return array
		 */
		public function get($key);

		/**
		 * @param $key
		 * @param array $value
		 * @return self
		 */
		public function set($key, array $value);

		/**
		 * @return self
		 */
		public function clear();
	}