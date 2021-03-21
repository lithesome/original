<?php

	namespace Core\Classes\Cache;

	use Core\Classes\Cache\Drivers\JSON;
	use Core\Classes\Cache\Drivers\PHP;
	use Core\Classes\Config;
	use Core\Interfaces\Cache\Cache as CacheInterface;
	use Core\Interfaces\Cache\DriverInterface;
	use Core\Interfaces\Cache\Getters;
	use Core\Interfaces\Cache\Setters;
	use Core\Traits\Cache\GettersSetters;

	/**
	 * @TEST
	 * @non-recommended-method
	 * pre(
	 *    \Core\Classes\Cache\Cache::driver(\Core\Classes\Cache\Drivers\JSON::class)    // set cache driver from object method
	 *    //\Core\Classes\Cache\Cache::driver(\Core\Classes\Cache\Drivers\PHP::class)    // set cache driver from object method
	 *        ->setKey('users.index')
	 *        ->set('unique_key',array('simple'=>'data'))
	 *        ->get('unique_key')
	 * );
	 * @recommended-method
	 * pre(
	 *    \Core\Classes\Cache\Cache::key('users.index')    // set cache driver from config
	 *        ->set('unique_key',array('simple'=>'data'))
	 *        ->get('unique_key')
	 * );
	 *
	 * Class Cache
	 * @package Core\Classes\Cache
	 */
	class Cache implements Getters, Setters, CacheInterface
	{
		use GettersSetters;

		protected $ttl;
		protected $key;
		protected $driver;

		public function __construct()
		{
			$this->setTtl(Config::cache('ttl'));
		}

		/**
		 * @param $key
		 * @return CacheInterface
		 */
		public static function key($key)
		{
			$self = new self();
			$self->setCacheDriver(Config::cache('driver'));
			return $self->setKey($key);
		}

		/**
		 * @param $cache_driver
		 * @return DriverInterface
		 */
		public static function driver($cache_driver)
		{
			$self = new self();
			return $self->setCacheDriver($cache_driver);
		}

		public function ttl($ttl)
		{
			return $this->setTtl($ttl);
		}

		public function get($key)
		{
			return Config::cache('enabled') ? $this->getCacheDriver()->get($key) : array();
		}

		public function set($key, array $value)
		{
			!Config::cache('enabled') ?: $this->getCacheDriver()->set($key, $value);
			return $this;
		}

		public function clear()
		{
			$this->getCacheDriver()->clear();
			return $this;
		}

		/**
		 * @return PHP
		 */
		protected function getCacheDriver()
		{
			return new $this->driver($this);
		}

		public function setCacheDriver($driver_class = JSON::class)
		{
			$this->driver = $driver_class;
			return $this;
		}
	}