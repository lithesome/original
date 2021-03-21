<?php

	namespace Core\Interfaces\Router;

	interface Maker
	{
		public function controller($value);

		public function action($value);

		public function pattern($value);

		public function mask($value);

		public function modifier($value);

		public function method($value);

		public function status($value);

		public function custom($key, $value);
	}