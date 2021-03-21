<?php

	namespace Core\Interfaces\Hooks;

	interface Maker
	{
		public function class($hook_class);

		public function method($hook_method);

		public function status($hook_status);

		public function relevance($hook_relevance);

		public function custom($key, $value);

		public function arguments(...$hook_arguments);
	}