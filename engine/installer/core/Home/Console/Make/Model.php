<?php

	namespace Controllers\Home\Console\Make;

	class Model extends Make
	{
		protected $target_template = 'Controllers/Home/Console/templates/__model__.php';

		public function __construct()
		{
			parent::__construct();
		}

		protected function setTargetParams()
		{
			$this->targets_dir_path = get_root_path("Controllers/" . $this->controller . "/Models");
			$this->target_file = $this->targets_dir_path . '/' . $this->target . '.php';
			return $this;
		}

		protected function replaceContent()
		{
			$table = strtolower($this->controller);
			$table .= ucfirst(str_replace('Model', '', $this->target));

			$this->target_content = str_replace(array(
				'__model__', '__controller_ns__', '__controller_c__', '__controller_cu__'
			), array(
				$this->target, $this->controller, $table, ucfirst($table)
			), $this->target_content);
			return $this;
		}
	}