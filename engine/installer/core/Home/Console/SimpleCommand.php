<?php

	namespace Controllers\Home\Console;

	class SimpleCommand
	{
		public function __construct()
		{
		}

		public function execute($param = 'simple')
		{
			return $this;
		}
	}