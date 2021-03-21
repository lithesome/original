<?php

	namespace Controllers\Home\Installer;

	use Controllers\Home\Model;
	use Core\Classes\Controller\Installer;

	class Install extends Installer
	{
		private $model;

		public function __construct()
		{
			$this->model = new Model();
		}

		public function execute()
		{
			return $this;
		}

		public function migrate()
		{
			return $this;
		}

		public function insert()
		{
			return $this;
		}

		public function escape()
		{
			return $this;
		}
	}