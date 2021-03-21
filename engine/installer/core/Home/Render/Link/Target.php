<?php

	namespace Controllers\Home\Render\Link;

	use Controllers\Home\Render\Link\Interfaces\Common;

	class Target
	{
		private $link;

		public function __construct(Common $link)
		{
			$this->link = $link;
		}

		public function blank()
		{
			$this->link->setTarget('_blank');
			return $this->link;
		}

		public function parent()
		{
			$this->link->setTarget('_parent');
			return $this->link;
		}

		public function self()
		{
			$this->link->setTarget('_self');
			return $this->link;
		}

		public function top()
		{
			$this->link->setTarget('_top');
			return $this->link;
		}
	}