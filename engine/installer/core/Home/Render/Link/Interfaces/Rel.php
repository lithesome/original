<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Rel
	{
		/**
		 * @return Attributes|Result
		 */
		public function alternate();

		/**
		 * @return Attributes|Result
		 */
		public function author();

		/**
		 * @return Attributes|Result
		 */
		public function bookmark();

		/**
		 * @return Attributes|Result
		 */
		public function external();

		/**
		 * @return Attributes|Result
		 */
		public function help();

		/**
		 * @return Attributes|Result
		 */
		public function license();

		/**
		 * @return Attributes|Result
		 */
		public function next();

		/**
		 * @return Attributes|Result
		 */
		public function nofollow();

		/**
		 * @return Attributes|Result
		 */
		public function noreferrer();

		/**
		 * @return Attributes|Result
		 */
		public function noopener();

		/**
		 * @return Attributes|Result
		 */
		public function prev();

		/**
		 * @return Attributes|Result
		 */
		public function search();

		/**
		 * @return Attributes|Result
		 */
		public function tag();
	}