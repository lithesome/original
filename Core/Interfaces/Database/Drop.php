<?php

	namespace Core\Interfaces\Database;

	interface Drop
	{
		/**
		 * @return Result
		 */
		public function exec();
	}