<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Params
	{
		/**
		 * @param $get_param_key
		 * @param $get_param_value
		 * @return Value|Params
		 */
		public function param($get_param_key, $get_param_value);
	}