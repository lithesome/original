<?php

	namespace Controllers\Home\Hooks;

	use Core\Classes\Config;
	use Core\Classes\Render;
	use Core\Classes\Widgets\Widgets;
	use Core\Classes\Response\Response as GeneralResponseSender;

	class Response
	{
		private $widgets = array();

		/** @var Render */
		private $render;
		/** @var Response */
		private $response;
		/** @var Widgets */
		private $widgets_instance;

		public function __construct()
		{
			$this->response = GeneralResponseSender::getInstance();
			$this->render = Render::getInstance();
		}

		public function setSiteNameToResponse()
		{
			$this->response->setTitleAndBreadCrumbs('main')
				->link('/')
				->value(Config::templates('site_name'))
				->icon('fas fa-home')
				->set();
			return $this;
		}

		public function setResponse()
		{
			$this->response->setMeta('charset', array(
				'charset' => 'utf-8'
			));
			$this->response->setMeta('generator', array(
				'name' => 'generator',
				'content' => Config::templates('site_name'),
			));
			$this->response->setMeta('viewport', array(
				'name' => 'viewport',
				'content' => 'width=device-width',
			));
			$this->response->setMeta('equiv', array(
				'http-equiv' => 'Content-Type',
				'content' => 'text/html; charset=UTF-8',
			));

			$title_tags = $this->response->getTitle();
			$this->response->setMeta('keywords', array(
				'name' => 'keywords',
				'content' => str_replace(array('"', '.',), array('', '',), implode(',', array_reverse($title_tags)))
			));
			$this->response->setMeta('description', array(
				'name' => 'description',
				'content' => str_replace('"', '', implode(': ', $title_tags))
			));
			return $this;
		}

		public function renderAllWidgets()
		{
			$this->widgets_instance = $this->render->renderWidgets();
			if (equal(strtolower($this->render->getRenderType()), 'html')) {
				$this->widgets_instance->executeAll(function ($widget) {
					$widget_file = get_root_theme($widget['template'] . '.html.php');
					if (file_exists($widget_file)) {
						return $this->render->render($widget_file, $widget);
					}
					return null;
				});
				return $this;
			}
			$this->renderWidgets();
			$this->response->setContent('widgets', $this->widgets);
			return $this;
		}

		private function renderWidgets()
		{
			foreach ($this->widgets_instance->getWidgets() as $position => $widgets) {
				$this->renderWidget($position, $widgets);
			}
			return $this;
		}

		private function renderWidget($position, $widgets)
		{
			foreach ($widgets as $relevance => $widget) {
				if (!equal($widget['status'], STATUS_ACTIVE)) {
					continue;
				}
				if ($this->widgets_instance->checkWidgetAccess($widget)) {
					$this->widgets[$position][$relevance] = $this->widgets_instance->runWidget($widget, null);
				}
			}
			return $this;
		}
	}