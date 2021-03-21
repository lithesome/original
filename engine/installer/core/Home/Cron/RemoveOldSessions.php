<?php

	namespace Controllers\Home\Cron;

	use Controllers\Home\Config;

	class RemoveOldSessions
	{
		protected $sessions_dir;
		protected $sessions_time;

		public function __construct()
		{
			$this->sessions_dir = get_root_path(Config::session('session_dir'));
			$this->sessions_time = Config::session('session_time');
		}

		public function execute()
		{
			$current_time = time();

			foreach (get_files_list($this->sessions_dir, '') as $file) {
				$expired_time = $this->sessions_time + filemtime($file);
				if ($expired_time < $current_time) {
					unlink($file);
				}
			}

			return true;
		}
	}