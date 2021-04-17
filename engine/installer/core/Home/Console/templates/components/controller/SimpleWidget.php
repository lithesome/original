<?php

	namespace Controllers\__controller_ns__\Widgets;

	use Core\Classes\Widgets\Widget;

	class SimpleWidget extends Widget
	{
		public function __construct()
		{
		}

		public function execute()
		{
			$this->setParam('content', array(
				'simple' => 'content has sets'
			));
			$this->setContent('simple', 'test');
			return $this;
		}
	}