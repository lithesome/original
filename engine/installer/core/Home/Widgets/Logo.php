<?php

	namespace Controllers\Home\Widgets;

	use Core\Classes\Config;
	use Core\Classes\Widgets\Widget;

	class Logo extends Widget
	{
		public function __construct()
		{
		}

		public function execute()
		{
			$this->setContent('image', Config::templates('logo'));
			return $this;
		}
	}