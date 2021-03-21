<?php

	namespace Core\Interfaces\Console;

	interface Maker
	{
		public function controller($value);

		public function method($value);

		public function command($value);

		public function example($value);

		public function description($value);

		public function pattern($value);

		public function mask($value);

		public function modifier($value);
	}