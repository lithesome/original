<?php

	namespace Controllers\Home\Hooks;

	class SimpleHook
	{
		public function __construct()
		{
		}

		public function execute()
		{
			return $this;
		}
	}
