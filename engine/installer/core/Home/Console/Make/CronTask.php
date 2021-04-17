<?php

	namespace Controllers\Home\Console\Make;

	class CronTask extends Make
	{
		protected $target_template = 'Controllers/Home/Console/templates/components/controller/SimpleCronTask.php';

		public function __construct()
		{
			parent::__construct();
		}

		protected function setTargetParams()
		{
			$this->targets_dir_path = get_root_path("Controllers/" . $this->controller . "/Cron");
			$this->target_file = $this->targets_dir_path . '/' . $this->target . '.php';
			return $this;
		}

		protected function replaceContent()
		{
			$this->target_content = str_replace(array(
				'SimpleCronTask', '__controller_ns__',
			), array(
				$this->target, $this->controller,
			), $this->target_content);
			return $this;
		}
	}