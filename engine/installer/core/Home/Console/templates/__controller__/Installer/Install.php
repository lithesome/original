<?php

	namespace Controllers\__controller_ns__\Installer;

	use Controllers\__controller_ns__\Model;
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
			$this->model->dropTable();
			$this->model->makeTable();
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