<?php

	namespace Controllers\Home\Render\Link;

	use Controllers\Home\Render\Link\Interfaces\Common;

	class Rel
	{
		private $link;

		public function __construct(Common $link)
		{
			$this->link = $link;
		}

		public function alternate()
		{
			$this->link->setRel('alternate');
			return $this->link;
		}

		public function author()
		{
			$this->link->setRel('author');
			return $this->link;
		}

		public function bookmark()
		{
			$this->link->setRel('bookmark');
			return $this->link;
		}

		public function external()
		{
			$this->link->setRel('external');
			return $this->link;
		}

		public function help()
		{
			$this->link->setRel('help');
			return $this->link;
		}

		public function license()
		{
			$this->link->setRel('license');
			return $this->link;
		}

		public function next()
		{
			$this->link->setRel('next');
			return $this->link;
		}

		public function nofollow()
		{
			$this->link->setRel('nofollow');
			return $this->link;
		}

		public function noreferrer()
		{
			$this->link->setRel('noreferrer');
			return $this->link;
		}

		public function noopener()
		{
			$this->link->setRel('noopener');
			return $this->link;
		}

		public function prev()
		{
			$this->link->setRel('prev');
			return $this->link;
		}

		public function search()
		{
			$this->link->setRel('search');
			return $this->link;
		}

		public function tag()
		{
			$this->link->setRel('tag');
			return $this->link;
		}
	}