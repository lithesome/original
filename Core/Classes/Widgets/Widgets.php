<?php

	namespace Core\Classes\Widgets;

	use Core\Classes\Access\Denied;
	use Core\Classes\Access\Granted;
	use Core\Classes\Response\Response;

	class Widgets
	{
		const CACHED_FILE = 'tmp/config/widgets.php';

		private static $instance;

		protected static $raw_widgets_list = array();
		protected $cached_widgets_file;

		/** @var Response */
		protected $response;

		protected $widgets_list = array();

		protected $content = array();

		/** @return self */
		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public static function register($widget_position, callable $callback_function)
		{
			$maker = new Maker();
			call_user_func($callback_function, $maker);
			$maker->position($widget_position);
			return self::setWidget($widget_position, $maker->getWidget());
		}

		public static function setWidget($widget_position, array $widget)
		{
			self::$raw_widgets_list[$widget_position][] = $widget;
			return true;
		}

		public function __construct()
		{
			$this->cached_widgets_file = get_root_path(self::CACHED_FILE);

			$this->response = Response::getInstance();
			$this->setWidgets();
			$this->sortWidgets();
		}

		public function isset($widgets_position)
		{
			return isset($this->content[$widgets_position]);
		}

		public function empty($widgets_position)
		{
			if ($this->isset($widgets_position)) {
				return empty($this->content[$widgets_position]);
			}
			return true;
		}

		public function count($widgets_position)
		{
			if ($this->isset($widgets_position)) {
				return count($this->content[$widgets_position]);
			}
			return 0;
		}

		public function get($widgets_position)
		{
			return $this->isset($widgets_position) ? $this->content[$widgets_position] : null;
		}

		public function getContent()
		{
			return $this->content;
		}

		public function getWidgets()
		{
			return $this->widgets_list;
		}

		public function executeAll(callable $render_callback_function = null)
		{
			foreach ($this->widgets_list as $position => $widgets) {
				$this->writeContent($position, $render_callback_function);
			}
			return $this;
		}

		public function writeContent($position, callable $render_callback_function = null)
		{
			$this->content[$position] = '';
			foreach ($this->widgets_list[$position] as $relevance => $widget) {
				if (!equal($widget['status'], STATUS_ACTIVE)) {
					continue;
				}
				if ($this->checkWidgetAccess($widget)) {
					$time = microtime(true);
					$this->content[$position] .= $this->runWidget($widget, $render_callback_function);
					$this->response->setDebug('Home.debug.debug_widgets', $time, array(
						$widget['position'],
						$widget['class'],
						$widget['method'] . '()'), debug_backtrace()
					);
				}
			}
			return $this;
		}

		public function runWidget($widget, callable $render_callback_function = null)
		{
			if (method_exists($widget['class'], $widget['method'])) {
				/** @var Widget $widgetObject */
				$widgetObject = new $widget['class']();
				$widgetObject->setParams($widget);
				call_user_func(array($widgetObject, $widget['method']));
				$widget = $widgetObject->getParams();
			}
			return $render_callback_function ? call_user_func($render_callback_function, $widget) : $widget;
		}

		public function checkWidgetAccess($widget)
		{
			if (isset($widget['access'])) {
				if (!$this->checkAccessGranted($widget['access']) || $this->checkAccessDenied($widget['access'])) {
					return false;
				}
			}
			return true;
		}

		protected function checkAccessGranted($widget)
		{
			if (isset($widget['granted'])) {
				/** @var Granted $accessor */
				$accessor = new $widget['granted']['accessor'];
				foreach ($widget['granted']['methods'] as $method => $params) {
					call_user_func_array(array($accessor, $method), array($params));
				}
				return $accessor->can();
			}
			return true;
		}

		protected function checkAccessDenied($widget)
		{
			if (isset($widget['denied'])) {
				/** @var Denied $accessor */
				$accessor = new $widget['denied']['accessor'];
				foreach ($widget['denied']['methods'] as $method => $params) {
					call_user_func_array(array($accessor, $method), array($params));
				}
				return $accessor->cant();
			}
			return false;
		}

		protected function setWidgets()
		{
			if (file_exists($this->cached_widgets_file)) {
				return $this->mergeWidgets(include $this->cached_widgets_file);
			}
			return $this->scanControllersDirs();
		}

		protected function scanControllersDirs()
		{
			foreach (get_dirs_list(get_root_path('Controllers')) as $file) {
				$widgets_file = $file . "/assets/widgets.php";
				if (file_exists($widgets_file)) {
					include $widgets_file;
				}
			}
			return $this;
		}

		protected function mergeWidgets($result)
		{
			self::$raw_widgets_list = array_merge_recursive(self::$raw_widgets_list, $result);
			return $this;
		}

		protected function sortWidgets()
		{
			foreach (self::$raw_widgets_list as $position => $widgets) {
				foreach ($widgets as $widget) {
					$index = $this->makeIndex($position, $widget['relevance']);
					$this->widgets_list[$position][$index] = $widget;
				}
				ksort($this->widgets_list[$position]);
			}
			ksort($this->widgets_list);
			return $this;
		}

		protected function makeIndex($key, $index)
		{
			if (!isset($this->widgets_list[$key][$index])) {
				return $index;
			}
			return $this->makeIndex($key, $index + 1);
		}

		public static function getWidgetsRawList()
		{
			return self::$raw_widgets_list;
		}

		public static function destroyWidgetsRawList()
		{
			self::$raw_widgets_list = array();
			return true;
		}
	}