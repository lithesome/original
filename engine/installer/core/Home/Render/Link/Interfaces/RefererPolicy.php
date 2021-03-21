<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface RefererPolicy
	{
		/**
		 * @return Result|Attributes
		 */
		public function noReferrer();

		/**
		 * @return Result|Attributes
		 */
		public function noReferrerWhenDowngrade();

		/**
		 * @return Result|Attributes
		 */
		public function origin();

		/**
		 * @return Result|Attributes
		 */
		public function originWhenCrossOrigin();

		/**
		 * @return Result|Attributes
		 */
		public function sameOrigin();

		/**
		 * @return Result|Attributes
		 */
		public function strictOriginWhenCrossOrigin();

		/**
		 * @return Result|Attributes
		 */
		public function unsafeUrl();
	}