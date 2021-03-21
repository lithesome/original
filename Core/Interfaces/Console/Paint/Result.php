<?php

	namespace Core\Interfaces\Console\Paint;

	interface Result
	{
		public function get($before = null, $after = PHP_EOL);

		public function print($before = null, $after = PHP_EOL);
	}