<?php

	namespace Core\Interfaces\Access;

	interface Access
	{
		/**
		 * @param $uri_mask
		 * @return self
		 */
		public function checkUrlMask($uri_mask);

		/**
		 * @param $controller
		 * @param $action
		 * @return self
		 */
		public function checkController($controller, $action);

		/**
		 * @param $status
		 * @return self
		 */
		public function access($status);

		/**
		 * @param array array $arguments
		 * @return self
		 */
		public function callback(array $arguments);
	}