<?php

	namespace Core\Classes\Cache\Drivers;

	use Core\Interfaces\Cache\Getters;

	class JSON extends PHP
	{
		/** @var Getters */
		protected $cache;

		protected $cache_dir = 'tmp/cache/dynamic/json/';
		protected $file_ext = 'json';

		public function __construct(Getters $cache)
		{
			parent::__construct($cache);
		}

		public function get($key)
		{
			$time = microtime(true);
			$cache_file = $this->getCacheFile($key);
			$cache_data = array();
			if (file_exists($cache_file) && filemtime($cache_file) + $this->cache->getTtl() > time()) {
				$cache_data = json_decode(file_get_contents($cache_file), true);
				$cache_data = is_array($cache_data) ? $cache_data : array();
			}
			return $this->setDebug($key, $time, $cache_data);
		}

		public function set($key, array $value)
		{
			if (!$value) {
				return $this;
			}
			$cache_file = $this->getCacheFile($key);
			file_put_contents($cache_file, json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			return $this;
		}
	}