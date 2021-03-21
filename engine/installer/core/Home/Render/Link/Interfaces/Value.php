<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Value
	{
		/**
		 * @param $value
		 * @return Result|Attributes
		 */
		public function value($value);
	}