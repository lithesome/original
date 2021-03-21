<?php

	namespace Controllers\Home\Render\Link;

	use Controllers\Home\Render\Link\Interfaces\Common;

	class ReferrerPolicy
	{
		private $link;

		public function __construct(Common $link)
		{
			$this->link = $link;
		}

		public function noReferrer()
		{
			$this->link->setReferrerPolicy('no-referrer');
			return $this->link;
		}

		public function noReferrerWhenDowngrade()
		{
			$this->link->setReferrerPolicy('no-referrer-when-downgrade');;
			return $this->link;
		}

		public function origin()
		{
			$this->link->setReferrerPolicy('origin');;
			return $this->link;
		}

		public function originWhenCrossOrigin()
		{
			$this->link->setReferrerPolicy('origin-when-cross-origin');;
			return $this->link;
		}

		public function sameOrigin()
		{
			$this->link->setReferrerPolicy('same-origin');;
			return $this->link;
		}

		public function strictOriginWhenCrossOrigin()
		{
			$this->link->setReferrerPolicy('strict-origin-when-cross-origin');;
			return $this->link;
		}

		public function unsafeUrl()
		{
			$this->link->setReferrerPolicy('unsafe-url');;
			return $this->link;
		}
	}