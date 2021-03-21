<?php

	namespace Controllers\Home\Cron;

	class SimpleCronTask
	{
		public function __construct()
		{
//			fatal_error_emulation = true
//			error_emulation_true;
		}

		public function execute(...$arguments)
		{
			return __METHOD__;
		}
	}