<?php

	namespace Controllers\Home\Render\Link\Traits;

	trait Attributes
	{
		public function setReferrerPolicy($value)
		{
			$this->attributes['referrerpolicy'] = $value;
			return $this;
		}

		public function setRel($value)
		{
			$this->attributes['rel'] = $value;
			return $this;
		}

		public function setTarget($value)
		{
			$this->attributes['target'] = $value;
			return $this;
		}

		public function getAttributes()
		{
			return $this->attributes;
		}
	}