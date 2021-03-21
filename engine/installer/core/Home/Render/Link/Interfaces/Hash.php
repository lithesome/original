<?php

	namespace Controllers\Home\Render\Link\Interfaces;

	interface Hash
	{
		/**
		 * @param $link_hash
		 * @return Value|Params
		 */
		public function hash($link_hash);
	}