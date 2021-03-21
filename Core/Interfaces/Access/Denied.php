<?php

	namespace Core\Interfaces\Access;

	interface Denied
	{
		/**
		 * @param array $controllers
		 * @return self
		 */
		public function checkControllers(array $controllers);

		/**
		 * @param array $uris_masks
		 * @return self
		 */
		public function checkUrlMasks(array $uris_masks);

		/**
		 * @param array $groups
		 * @return self
		 */
		public function checkGroups(array $groups);

		/**
		 * @param $status
		 * @return self
		 */
		public function access($status);

		/**
		 * @return boolean
		 */
		public function cant();
	}