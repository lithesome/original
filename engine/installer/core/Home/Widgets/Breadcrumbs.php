<?php

	namespace Controllers\Home\Widgets;

	use Controllers\Home\Config;
	use Core\Classes\Request;
	use Core\Classes\Response\Response;
	use Core\Classes\Widgets\Widget;

	class Breadcrumbs extends Widget
	{
		private $response;
		private $request;

		public function __construct()
		{
			$this->request = Request::getInstance();
			$this->response = Response::getInstance();
		}

		public function execute()
		{
			if (!Config::templates('breadcrumbs_on_main') && !$this->request->getRequestUri()) {
				return $this->params;
			}
			$this->setParam('content', $this->response->getBreadCrumbs());
			return $this;
		}
	}