<?php

	namespace Core\Classes\Cache\Drivers;

	use Core\Interfaces\Cache\Getters;
	use Core\Classes\Response\Response;

	class PHP
	{
		/** @var Getters */
		protected $cache;

		protected $response;

		protected $cache_dir = 'tmp/cache/dynamic/php/';
		protected $cache_path;
		protected $file_ext = 'php';

		public function __construct(Getters $cache)
		{
			$this->cache = $cache;
			$this->response = Response::getInstance();
			$this->cache_dir = get_root_path($this->cache_dir);
			$this->prepareKey();
			make_dir($this->cache_path);
		}

		public function get($key)
		{
			$time = microtime(true);
			$cache_file = $this->getCacheFile($key);
			$cache_data = array();
			if (file_exists($cache_file) && filemtime($cache_file) + $this->cache->getTtl() > time()) {
				$cache_data = include $cache_file;
				$cache_data = is_array($cache_data) ? $cache_data : array();
			}
			return $this->setDebug($key, $time, $cache_data);
		}

		protected function setDebug($key, $time, $cache_data)
		{
			if ($cache_data) {
				$this->response->setDebug('Home.debug.debug_cache', $time, $key, debug_backtrace());
			}
			return $cache_data;
		}

		public function set($key, array $value)
		{
			if (!$value) {
				return $this;
			}
			$cache_file = $this->getCacheFile($key);
			file_put_contents($cache_file, php_encode($value));
			return $this;
		}

		public function clear()
		{
			scan_dir_recursive_callback($this->cache_path, function ($file_or_dir) {
				if (is_dir($file_or_dir)) {
					rmdir($file_or_dir);
					return true;
				}
				unlink($file_or_dir);
				return $this;
			});
			if (is_dir($this->cache_path)) {
				rmdir($this->cache_path);
			}
			return $this;
		}

		protected function getCacheFile($key)
		{
			return $this->cache_path . DIRECTORY_SEPARATOR . $key . '.' . $this->file_ext;
		}

		protected function prepareKey()
		{
			$this->cache_path = $this->cache_dir . str_replace('.', DIRECTORY_SEPARATOR, $this->cache->getKey());
			return $this;
		}
	}