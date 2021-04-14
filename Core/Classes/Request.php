<?php

	namespace Core\Classes;

	/**
	 * Class Request
	 * @package Core\Classes
	 * @method self query($key, $value = null)
	 * @method self header($key, $value = null)
	 */
	class Request
	{
		private $request = array();
		private $headers = array();

		private $request_uri;
		private $request_method;
		private $request_query = array();

		private static $instance;

		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __toString()
		{
			return '';
		}

		public function __call($name, $arguments)
		{
			if (key_exists(1, $arguments)) {
				$method = 'set' . $name;
				return method_exists($this, $method) ? $this->{$method}(...$arguments) : $this;
			}
			$method = 'get' . $name;
			return method_exists($this, $method) ? $this->{$method}(...$arguments) : null;
		}

		public function __construct()
		{
		}

		public function setRequestArray(array $request)
		{
			$request_data = $this->setRequestArrayRecursive($request);
			$this->request = $request_data;
			return $this;
		}

		private function setRequestArrayRecursive($request)
		{
			if (is_array($request)) {
				foreach ($request as $key => $value) {
					if (is_array($value)) {
						$request[$key] = $this->setRequestArrayRecursive($value);
						continue;
					}
					$request[$key] = trim($value);
				}
				return $request;
			}
			return trim($request);
		}

		public function setHeadersArray(array $headers)
		{
			foreach ($headers as $key => $value) {
				$this->setHeader($key, $value);
			}
			return $this;
		}

		public function setQuery($key, $value)
		{
			$this->request[$key] = trim($value);
			return $this;
		}

		public function setHeader($key, $value)
		{
			$key = mb_strtolower($key);
			$this->headers[$key] = trim($value);
			return $this;
		}

		public function getQuery($key)
		{
			if (isset($this->request[$key])) {
				return $this->request[$key];
			}
			return null;
		}

		public function getRequests()
		{
			return $this->request;
		}

		public function getHeaders()
		{
			return $this->headers;
		}

		public function getHeader($key)
		{
			$key = mb_strtolower($key);
			if (isset($this->headers[$key])) {
				return $this->headers[$key];
			}
			return null;
		}

		public function getRequestUri()
		{
			return $this->request_uri;
		}

		public function getRequestQuery()
		{
			return $this->request_query;
		}

		public function getRequestMethod()
		{
			return $this->request_method;
		}

		public function setRequestUri($request_uri)
		{
			$this->request_uri = trim(urldecode(parse_url($request_uri, PHP_URL_PATH)), '/');
			return $this;
		}

		public function setRequestQuery($request_uri)
		{
			parse_str(parse_url($request_uri, PHP_URL_QUERY), $this->request_query);
			return $this;
		}

		public function setRequestMethod($request_method)
		{
			$this->request_method = strtolower($request_method);
			return $this;
		}
	}