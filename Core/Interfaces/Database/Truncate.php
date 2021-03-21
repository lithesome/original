<?php

	namespace Core\Interfaces\Database;

	interface Truncate
	{
		/**
		 * @return Result
		 */
		public function exec();
	}