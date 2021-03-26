<?php

	namespace Controllers\__controller_ns__\Actions;

	use Controllers\__controller_ns__\Controller as ParentController;

	/**
	 * Class __action_ns__
	 * @package Controllers\__controller_ns__\Actions
	 * Register new hook on events list
	 * @event [common] run_controller_before
	 * @event [common] run_controller_after
	 * @event [personal] __controller_ns__::__action_ns___before
	 * @event [personal] __controller_ns__::__action_ns___after
	 */
	class __action_ns__ extends ParentController
	{
		public function __construct()
		{
			parent::__construct();
			$this->response->setController('__controller_ns__');
			$this->response->setAction('__action_ns__');
		}

		public function getMethod()
		{
			return $this;
		}

		public function postMethod()
		{
			return $this;
		}

		public function putMethod()
		{
			return $this;
		}

		public function headMethod()
		{
			return $this;
		}

		public function deleteMethod()
		{
			return $this;
		}

		public function traceMethod()
		{
			return $this;
		}

		public function patchMethod()
		{
			return $this;
		}

		public function optionsMethod()
		{
			return $this;
		}

		public function connectMethod()
		{
			return $this;
		}
	}