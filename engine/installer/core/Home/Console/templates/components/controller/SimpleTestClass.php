<?php

	namespace Controllers\__controller_ns__\Test;

	use Controllers\__controller_ns__\Model;

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