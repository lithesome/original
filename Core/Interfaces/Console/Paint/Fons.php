<?php

	namespace Core\Interfaces\Console\Paint;

	interface Fons
	{
		/**
		 * @return Colors|Result
		 */
		public function fonBlack();

		/**
		 * @return Colors|Result
		 */
		public function fonRed();

		/**
		 * @return Colors|Result
		 */
		public function fonGreen();

		/**
		 * @return Colors|Result
		 */
		public function fonYellow();

		/**
		 * @return Colors|Result
		 */
		public function fonBlue();

		/**
		 * @return Colors|Result
		 */
		public function fonMagenta();

		/**
		 * @return Colors|Result
		 */
		public function fonCyan();

		/**
		 * @return Colors|Result
		 */
		public function fonLightGray();
	}