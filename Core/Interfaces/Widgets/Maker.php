<?php

	namespace Core\Interfaces\Widgets;

	interface Maker
	{
		public function key($value);

		public function title($value);

		public function class($value);

		public function method($value);

		public function position($value);

		public function template($value);

		public function relevance($value);

		public function status($value);

		public function arguments(array $value);

		public function options(array $value);

		public function custom($key, $value);
	}