<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Target
	{
		/**
		 * @return Attributes|Result
		 */
		public function blank();

		/**
		 * @return Attributes|Result
		 */
		public function parent();

		/**
		 * @return Attributes|Result
		 */
		public function self();

		/**
		 * @return Attributes|Result
		 */
		public function top();
	}