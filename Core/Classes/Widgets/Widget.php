<?php

	namespace Core\Classes\Widgets;

	class Widget
	{
		protected $params = array();

		public function setContent($key, $value)
		{
			$this->params['content'][$key] = $value;
			return $this;
		}

		public function setOption($key, $value)
		{
			$this->params['options'][$key] = $value;
			return $this;
		}

		public function getContent($key)
		{
			return isset($this->params['content'][$key]) ? $this->params['content'][$key] : null;
		}

		public function getOption($key)
		{
			return isset($this->params['options'][$key]) ? $this->params['options'][$key] : null;
		}

		public function setParam($key, $value)
		{
			$this->params[$key] = $value;
			return $this;
		}

		public function getParam($key)
		{
			return isset($this->params[$key]) ? $this->params[$key] : null;
		}

		public function setParams(array $params)
		{
			$this->params = $params;
			return $this;
		}

		public function getParams()
		{
			return $this->params;
		}
	}