<?php

	namespace Core\Interfaces\Test;

	interface Maker
	{
		public function class($class);

		public function method($method);

		public function params(...$params);

		public function status($status);

		public function relevance($relevance);
	}