<?php

	namespace Core\Classes\Response;

	use Core\Classes\Config;
	use Core\Classes\Session\Session;

	class Response
	{
		private $code = 200;
		private $status = '200 OK';
		private $location = '/';
		private $controller = '';
		private $action = '';
		private $content = array();
		private $headers = array();
		private $title = array();
		private $meta = array();
		private $breadcrumbs = array();
		private $debug = array();

		private static $allowed_statuses = array(
			100 => "100 Continue",
			101 => "101 Switching Protocol",
			200 => "200 OK",
			201 => "201 Created",
			202 => "202 Accepted",
			203 => "203 Non-Authoritative Information",
			204 => "204 No Content",
			205 => "205 Reset Content",
			206 => "206 Partial Content",
			300 => "300 Multiple Choices",
			301 => "301 Moved Permanently",
			302 => "302 Found",
			303 => "303 See Other",
			304 => "304 Not Modified",
			307 => "307 Temporary Redirect",
			308 => "308 Permanent Redirect",
			400 => "400 Bad Request",
			401 => "401 Unauthorized",
			403 => "403 Forbidden",
			404 => "404 Not Found",
			405 => "405 Method Not Allowed",
			406 => "406 Not Acceptable",
			407 => "407 Proxy Authentication Required",
			408 => "408 Request Timeout",
			409 => "409 Conflict",
			410 => "410 Gone",
			411 => "411 Length Required",
			412 => "412 Precondition Failed",
			413 => "413 Payload Too Large",
			414 => "414 URI Too Long",
			415 => "415 Unsupported Media Type",
			416 => "416 Range Not Satisfiable",
			417 => "417 Expectation Failed",
			418 => "418 I'm a teapot",
			422 => "422 Unprocessable Entity",
			425 => "425 Too Early",
			426 => "426 Upgrade Required",
			428 => "428 Precondition Required",
			429 => "429 Too Many Requests",
			431 => "431 Request Header Fields Too Large",
			451 => "451 Unavailable For Legal Reasons",
			500 => "500 Internal Server Error",
			501 => "501 Not Implemented",
			502 => "502 Bad Gateway",
			503 => "503 Service Unavailable",
			504 => "504 Gateway Timeout",
			505 => "505 HTTP Version Not Supported",
			511 => "511 Network Authentication Required",
			102 => '102 Processing',
			103 => '103 Early Hints',
			305 => '305 Use Proxy',
			306 => '306 Switch Proxy',
			402 => '402 Payment Required',
		);

		private static $instance;

		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function setCode($code)
		{
			if (isset(self::$allowed_statuses[$code])) {
				$this->code = $code;
				return $this->setStatus(self::$allowed_statuses[$code]);
			}
			return $this;
		}

		public function getCode()
		{
			return $this->code;
		}

		public function setStatus($status)
		{
			$this->status = $status;
			return $this;
		}

		public function getStatus()
		{
			return $this->status;
		}

		public function setLocation($location)
		{
			$this->location = $location;
			return $this;
		}

		public function getLocation()
		{
			return $this->location;
		}

		public function setController($controller)
		{
			$this->controller = $controller;
			return $this;
		}

		public function getController()
		{
			return $this->controller;
		}

		public function setAction($action)
		{
			$this->action = $action;
			return $this;
		}

		public function getAction()
		{
			return $this->action;
		}

		public function setContent($key, $value)
		{
			$this->content[$key] = $value;
			return $this;
		}

		public function getContent($key = null)
		{
			if (isset($this->content[$key])) {
				return $this->content[$key];
			}
			return $this->content;
		}

		public function setHeader($key, $value)
		{
			$this->headers[$key] = $value;
			return $this;
		}

		public function getHeader($key = null)
		{
			if (isset($this->headers[$key])) {
				return $this->headers[$key];
			}
			return $this->headers;
		}

		public function setTitle($key, $title)
		{
			$this->title[$key] = $title;
			return $this;
		}

		public function getTitle($key = null)
		{
			if (isset($this->title[$key])) {
				return $this->title[$key];
			}
			return $this->title;
		}

		public function setMeta($key, array $value)
		{
			$this->meta[$key] = $value;
		}

		public function getMeta($key = null)
		{
			if (isset($this->meta[$key])) {
				return $this->meta[$key];
			}
			return $this->meta;
		}

		public function setTitleAndBreadCrumbs($key)
		{
			return new Breadcrumbs($this, $key);
		}

		public function setBreadCrumbs($key, $link, $value, $icon = null)
		{
			$this->breadcrumbs[$key] = array(
				'link' => $link,
				'value' => $value,
				'icon' => $icon
			);
			return $this;
		}

		public function getBreadCrumbs($key = null)
		{
			if (isset($this->breadcrumbs[$key])) {
				return $this->breadcrumbs[$key];
			}
			return $this->breadcrumbs;
		}

		public function setDebug($key, $time, $query, $trace = array(), $index = 1)
		{
			if (!Config::core('debug')) {
				return $this;
			}

			$value['index'] = $index;
			$value['time'] = number_format(microtime(true) - $time, 10);
			$value['query'] = $query;
			$value['trace'] = $trace ? $trace : debug_backtrace();
			$this->debug[$key][] = $value;
			return $this;
		}

		public function getDebug($key = null)
		{
			if (isset($this->debug[$key])) {
				return $this->debug[$key];
			}
			return $this->debug;
		}

		public function redirect($location = null, $code = 302)
		{
			if (!$location) {
				$location = Session::system('location');
			}
			$location = trim($location, '/');
			$this->setCode($code)
				->setHeader('Location', "/{$location}");
			return $this;
		}
	}