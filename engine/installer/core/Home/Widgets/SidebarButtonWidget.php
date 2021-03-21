<?php

	namespace Controllers\Home\Widgets;

	use Core\Classes\Widgets\Widget;

	class SidebarButtonWidget extends Widget
	{
		public function __construct()
		{
		}

		public function execute()
		{
			$this->setParam('content', 'content has sets');
			$this->setContent('simple', 'test');
			return $this;
		}
	}