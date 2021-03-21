<?php

	namespace Controllers\Home\Test;

	use Controllers\Home\Model;

	class SimpleTestClass
	{
		protected $model;

		public function __construct()
		{
			$this->model = new Model();
		}

		public function execute()
		{
			return $this;
		}
	}