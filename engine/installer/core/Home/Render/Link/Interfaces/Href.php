<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Href
	{
		/**
		 * @param $router_key
		 * @param array ...$router_params
		 * @return Value|Params|Hash
		 */
		public function href($router_key, ...$router_params);
	}