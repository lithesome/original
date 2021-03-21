<?php

	namespace Widgets;

	use Core\Classes\Widgets\Widgets;

	/**
	 * Class HeadPanel
	 * @package Widgets
	 *
	 * @TEST
	 * $header = HeadPanel::set($string_variable);
	 * for($i=0;$i<5;$i++){
	 *    $header->key('item_' . $i)
	 *        ->url('/home/' . $integer_variable .'/' . 'item_' . $i)
	 *        ->value(gen(5));
	 * }
	 * $header->register();
	 *
	 */
	class HeadPanel
	{
		protected $current_key;
		protected $links = array();
		protected $key;
		protected $scope = array(
			'key' => '',
			'class' => '',
			'title' => 'Home.widget.simple_widget_name',
			'method' => 'execute',
			'status' => STATUS_ACTIVE,
			'content' => array(),
			'options' => array(),
			'position' => 'before_content',
			'template' => 'widgets/head_panel',
			'relevance' => 100001,
			'arguments' => array(),
		);

		public static function set($current_key)
		{
			return new self($current_key);
		}

		public function __construct($current_key)
		{
			$this->current_key = $current_key;
		}

		public function register()
		{
			$this->setOption('current_key', $this->current_key);
			$this->setOption('links', $this->links);
			Widgets::setWidget($this->scope['position'], $this->scope);
			return $this;
		}

		public function key($key)
		{
			$this->key = $key;
			return $this;
		}

		public function url($url)
		{
			$this->links[$this->key]['url'] = $url;
			return $this;
		}

		public function value($value)
		{
			$this->links[$this->key]['value'] = $value;
			return $this;
		}

		public function icon($value = 'fa fa-anchor')
		{
			$this->links[$this->key]['icon'] = $value;
			return $this;
		}

		public function setOption($key, $value)
		{
			$this->scope[$key] = $value;
			return $this;
		}
	}