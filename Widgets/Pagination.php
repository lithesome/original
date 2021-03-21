<?php

	namespace Widgets;

	use Core\Classes\Request;
	use Core\Classes\Widgets\Widgets;

	/**
	 * Class Pagination
	 * @package Widgets
	 *
	 * @TEST
	 * $offset = (int)$this->request->query('offset');
	 * $limit = 10;
	 * $total = 1000;
	 *
	 * $items = range($offset, $limit+$offset);
	 *
	 * Pagination::set('/')
	 *    ->limit($limit)
	 *    ->total($total)
	 *    ->offset($offset)
	 *    ->register();
	 *
	 */
	class Pagination
	{
		private $total;
		private $limit;
		private $offset;
		private $link = array();
		protected $scope = array(
			'key' => '',
			'class' => '',
			'title' => 'Home.widget.simple_widget_name',
			'method' => 'execute',
			'status' => STATUS_ACTIVE,
			'content' => array(),
			'options' => array(),
			'position' => 'content_down',
			'template' => 'widgets/pagination',
			'relevance' => 9990,
			'arguments' => array(),
		);

		private $request;

		public static function set($link = null)
		{
			$self = new self();
			return $self->link($link);
		}

		public function __construct()
		{
			$this->request = Request::getInstance();
		}

		public function total($value)
		{
			$this->total = $value;
			return $this;
		}

		public function limit($value)
		{
			$this->limit = $value;
			return $this;
		}

		public function offset($value)
		{
			$this->offset = $value;
			return $this;
		}

		public function link($value)
		{
			$this->link = '/' . trim($value ? $value : $this->request->getRequestUri(), '/');
			return $this;
		}

		public function register()
		{
			if ($this->total <= $this->limit) {
				return $this;
			}
			$this->setOption('total', $this->total);
			$this->setOption('limit', $this->limit);
			$this->setOption('link', $this->link);
			$this->setOption('offset', $this->offset);
			Widgets::setWidget($this->scope['position'], $this->scope);
			return $this;
		}

		public function setOption($key, $value)
		{
			$this->scope[$key] = $value;
			return $this;
		}
	}