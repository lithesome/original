<?php

	namespace Controllers\__controller_ns__;

	use Core\Classes\Controller\Controller as ParentController;

	class Controller extends ParentController
	{
		/** @var Model */
		public $model;

		public $limit = 15;
		public $offset = 0;
		public $total;

		public function __construct()
		{
			parent::__construct();
			$this->model = new Model();
			$this->offset = (int)$this->request->query('offset') ?: $this->offset;
		}

		/**
		 * Leave or remove this route from
		 * @route-file Controllers/__controller_ns__/assets/router.php
		 * @route-key __controller_c__
		 * @route-url /__controller_c__
		 * @route-method ANY
		 * Register new hook on events list
		 * @event [common] run_controller_before
		 * @event [common] run_controller_after
		 * @event [personal] __controller_ns__::index_before
		 * @event [personal] __controller_ns__::index_after
		 * @return Controller
		 */
		public function index()
		{
			$this->response->setController('__controller_ns__');
			$this->response->setAction('index');
			return $this->setResponse();
		}

		public function setResponse()
		{
			$this->response->setTitleAndBreadCrumbs('index')
				->link(uri('__controller_c__'))
				->value(lang(Config::__controller_ns__('controller_name')))
				->icon(Config::__controller_ns__('controller_icon'))
				->set();
			return $this;
		}

	}