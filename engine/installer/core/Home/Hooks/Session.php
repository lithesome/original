<?php

	namespace Controllers\Home\Hooks;

	use Core\Classes\Request;
	use Core\Classes\Response\Response;
	use Core\Classes\Session\Session as GeneralSessionInterface;

	class Session
	{
		/** @var Response */
		private $response;
		/** @var Request */
		private $request;

		public function __construct()
		{
			$this->response = Response::getInstance();
			$this->request = Request::getInstance();
		}

		public function execute()
		{
			if ($this->response->getCode() < 300 && !$this->request->query('noRedirect')) {
				GeneralSessionInterface::system('location', $this->request->getRequestUri());
			}
			return $this;
		}
	}