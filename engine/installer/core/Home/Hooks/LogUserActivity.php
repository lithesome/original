<?php

	namespace Controllers\Home\Hooks;

	use Core\Classes\Request;
	use Core\Classes\Session\Session;
	use Core\Classes\Response\Response;

	class LogUserActivity
	{
		protected $request;

		protected $response;

		protected $delimiter = '	||	';

		protected $file_name;

		protected $file_path = 'tmp/logs/activity';

		protected $user_info = array();

		public function __construct()
		{
			$this->request = Request::getInstance();
			$this->response = Response::getInstance();
			$this->file_name = $_SERVER['REMOTE_ADDR'];
			$this->file_path .= '/' . date('Y');
			$this->file_path .= '/' . date('m');
			$this->file_path .= '/' . date('d');
			$this->file_path .= '/' . $this->file_name . '.txt';
		}

		public function execute()
		{
			$this->setUserData();
			$this->saveActivity();
			return $this;
		}

		public function setUserData()
		{
			$this->user_info = array(
				'user_id' => Session::auth('id'),
				'response_code' => $this->response->getCode(),
				'date_log' => time(),
				'request_method' => $this->request->getRequestMethod(),
				'request_uri' => $this->request->getRequestUri(),
				'user_agent' => $this->request->header('user-agent'),
//				'data'			=> json_encode($this->request->getRequests()),
			);
			return $this;
		}

		public function saveActivity()
		{
			$file_path = get_root_path($this->file_path);
			if (!file_exists($file_path)) {
				make_dir(dirname($file_path));
				$this->saveLogHeader($file_path);
			}
			file_put_contents($file_path, implode($this->delimiter, $this->user_info) . "\r\n", FILE_APPEND);
			return $this;
		}

		public function saveLogHeader($file_path)
		{
			file_put_contents($file_path, implode($this->delimiter, array_keys($this->user_info)) . "\r\n");
			return $this;
		}
	}
