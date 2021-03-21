<?php

	namespace Widgets;

	use Core\Classes\Widgets\Widgets;

	/**
	 * Class SortPanel
	 * @package Widgets
	 *
	 * @TEST
	 * $sorting = SortPanel::set($string_variable);
	 * $sorting->sort($this->request->query('sorting'));
	 * for($i=0;$i<5;$i++){
	 *    $sorting->key('item_' . $i)
	 *        ->url('/home/' . $integer_variable .'/' . 'item_' . $i)
	 *        ->value(gen(5));
	 * }
	 * $sorting->register();
	 *
	 */
	class SortPanel
	{
		protected $current_key;
		protected $sort;
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
			'template' => 'widgets/sort_panel',
			'relevance' => 100000,
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

		public function setOption($key, $value)
		{
			$this->scope[$key] = $value;
			return $this;
		}

		public function register()
		{
			$this->setOption('current_key', $this->current_key);
			$this->setOption('links', $this->links);
			$this->setOption('sort', $this->sort);
			Widgets::setWidget($this->scope['position'], $this->scope);
			return $this;
		}

		public function key($key)
		{
			$this->key = $key;
			return $this;
		}

		public function sort($key)
		{
			$this->sort = $key;
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
	}