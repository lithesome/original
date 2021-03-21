<?php

	namespace Core\Interfaces\Database;

	interface Make
	{
		/**
		 * @return Result
		 */
		public function exec();
	}