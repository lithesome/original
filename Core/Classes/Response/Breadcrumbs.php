<?php

	namespace Core\Classes\Response;

	class Breadcrumbs
	{
		private $scope = array(
			'link' => '',
			'value' => '',
			'icon' => '',
		);
		private $key;
		private $response;

		public function __construct(Response $response, $key)
		{
			$this->response = $response;
			$this->key = $key;
		}

		public function link($link)
		{
			$this->scope['link'] = $link;
			return $this;
		}

		public function icon($icon)
		{
			$this->scope['icon'] = $icon;
			return $this;
		}

		public function value($value)
		{
			$this->scope['value'] = $value;
			return $this;
		}

		public function set()
		{
			$this->setTitle();
			$this->response->setBreadCrumbs($this->key, $this->scope['link'], $this->scope['value'], $this->scope['icon']);
			return $this;
		}

		private function setTitle()
		{
			$this->response->setTitle($this->key, $this->scope['value']);
			return $this;
		}
	}