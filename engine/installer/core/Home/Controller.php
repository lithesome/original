<?php

	namespace Controllers\Home;

	use Core\Classes\Controller\Controller as ParentController;
	use Core\Classes\Forms\Captcha;

	class Controller extends ParentController
	{
		protected $model;

		protected $limit = 15;
		protected $offset = 0;
		protected $total;

		public function __construct()
		{
			parent::__construct();
			$this->model = new Model();
			$this->response->setController('Home');

			$this->offset = (int)$this->request->query('offset') ?: $this->offset;
		}

		public function index()
		{
			$this->response->setAction('index');
			$this->response->setContent('hello_world', 'Hello World!');
			return $this;
		}

		public function getNewCaptcha()
		{
			$this->response->setCode(301);
			$captchaProvider = new Captcha();
			$this->response->setContent('captcha', $captchaProvider->setCaptchaImage());
			return $this;
		}
	}
