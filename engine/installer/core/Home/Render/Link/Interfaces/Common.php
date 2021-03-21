<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Common
	{
		public function href($router_key, ...$router_params);

		public function hash($link_hash);

		public function class($value);

		public function style($key, $value);

		public function id($value);

		public function title($value);

		public function download($value);

		public function hreflang($value);

		public function media($value);

		public function ping($value);

		public function referrerpolicy();

		public function target();

		public function rel();

		public function type($value);

		public function attr($attribute_key, $attribute_value);

		public function value($value);

		public function param($get_param_key, $get_param_value);

		public function get();

		public function print();

		public function setReferrerPolicy($value);

		public function setRel($value);

		public function setTarget($value);

		public function getAttributes();
	}