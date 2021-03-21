<?php

	namespace Core\Interfaces\Cache;

	interface Getters
	{
		public function getTtl();

		public function getKey();
	}