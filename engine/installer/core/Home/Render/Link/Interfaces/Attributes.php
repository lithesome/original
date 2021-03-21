<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Attributes
	{
		/**
		 * @param $value
		 * @return Attributes|Result
		 */
		public function class($value);

		/**
		 * @param $key
		 * @param $value
		 * @return Attributes|Result
		 */
		public function style($key, $value);

		/**
		 * @param $value
		 * @return Attributes|Result
		 */
		public function id($value);

		/**
		 * @param $value
		 * @return Attributes|Result
		 */
		public function title($value);

		/**
		 * @param $value
		 * @return Attributes|Result
		 */
		public function download($value);

		/**
		 * @param $value
		 * @return Attributes|Result
		 */
		public function hreflang($value);

		/**
		 * @param $value
		 * @return Attributes|Result
		 */
		public function media($value);

		/**
		 * @param $value
		 * @return Attributes|Result
		 */
		public function ping($value);

		/**
		 * @return RefererPolicy
		 */
		public function referrerpolicy();

		/**
		 * @return Target
		 */
		public function target();

		/**
		 * @return Rel
		 */
		public function rel();

		/**
		 * @param $value
		 * @return Attributes|Result
		 */
		public function type($value);

		/**
		 * @param $attribute_key
		 * @param $attribute_value
		 * @return Attributes|Result
		 */
		public function attr($attribute_key, $attribute_value);
	}