<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Result
	{
		/**
		 * @return string
		 */
		public function get();

		/**
		 * @return string
		 */
		public function print();

		/**
		 * @return array
		 */
		public function getAttributes();
	}