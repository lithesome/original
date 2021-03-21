<?php

	namespace Core\Interfaces\Console\Paint;

	interface Colors
	{
		/**
		 * @return Fons|Result
		 */
		public function colorBlack();

		/**
		 * @return Fons|Result
		 */
		public function colorBlue();

		/**
		 * @return Fons|Result
		 */
		public function colorGreen();

		/**
		 * @return Fons|Result
		 */
		public function colorCyan();

		/**
		 * @return Fons|Result
		 */
		public function colorRed();

		/**
		 * @return Fons|Result
		 */
		public function colorPurple();

		/**
		 * @return Fons|Result
		 */
		public function colorBrown();

		/**
		 * @return Fons|Result
		 */
		public function colorYellow();

		/**
		 * @return Fons|Result
		 */
		public function colorWhite();

		/**
		 * @return Fons|Result
		 */
		public function colorLightGray();

		/**
		 * @return Fons|Result
		 */
		public function colorLightPurple();

		/**
		 * @return Fons|Result
		 */
		public function colorLightRed();

		/**
		 * @return Fons|Result
		 */
		public function colorLightCyan();

		/**
		 * @return Fons|Result
		 */
		public function colorLightGreen();

		/**
		 * @return Fons|Result
		 */
		public function colorLightBlue();

		/**
		 * @return Fons|Result
		 */
		public function colorDarkGray();
	}