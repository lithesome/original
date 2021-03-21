<?php

	namespace Core\Classes;

	use Core\Classes\Router\Router;
	use Core\Classes\Widgets\Widgets;
	use Core\Traits\Render\Files;
	use Core\Traits\Render\RenderTypes;
	use Core\Classes\Response\Response;

	class Render
	{
		use Files;
		use RenderTypes;

		/** @var Request */
		public $request;
		/** @var Response */
		public $response;
		/** @var Router */
		public $router;

		public $render_type = 'html';
		public $html_content = '';

		/** @var Widgets */
		public $widgets;

		private static $instance;

		public static function getInstance()
		{
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct()
		{
			$this->request = Request::getInstance();
			$this->response = Response::getInstance();
			$this->router = Router::getInstance();
			$this->spotDataRenderingType(strtolower($this->request->header('Accept')));
		}

		public function spotDataRenderingType($accept_type)
		{
			preg_match_all("#([a-z]+)\/([a-z]+)#", $accept_type, $accept_types);
			if (isset($accept_types[2]) && !empty($accept_types[2])) {
				foreach ($accept_types[2] as $accept_type_) {
					if ($this->checkDesiredMethod($accept_type_)) {
						$this->setRenderType($accept_type_);
						break;
					}
				}
			}
			return $this;
		}

		protected function checkDesiredMethod($method)
		{
			return method_exists($this, 'getRenderType' . $method . 'Content');
		}

		public function startRendering()
		{
			if ($this->request->query('JSONP_callback')) {
				$this->render_type = 'JavaScript';
			}
			$render_method = "getRenderType" . $this->render_type . "Content";
			return $this->{$render_method}();
		}

		protected function renderMainTemplateFile()
		{
			include get_root_theme('index.html.php');
			return $this;
		}

		protected function renderController()
		{
			$controller_file = get_root_theme('controllers/' . $this->response->getController() . '/actions/' . $this->response->getAction() . '.html.php');
			if (file_exists($controller_file)) {
				$this->setContent($controller_file, $this->response->getContent());
			}
			return $this;
		}

		protected function checkError($error_code)
		{
			$error_file = get_root_theme('assets/errors/' . $error_code . '.html.php');
			if (file_exists($error_file)) {
				return $this->setContent($error_file, array());
			}
			return false;
		}

		public function render($file, array $content)
		{
			ob_start();
			extract($content);
			include $file;
			return ob_get_clean();
		}

		public function setContent($file, array $content)
		{
			$this->html_content = $this->render($file, $content);
			return $this;
		}

		public function getContent()
		{
			return $this->html_content;
		}

		protected function sendHeaders($headers, $status, $code)
		{
			foreach ($headers as $header_key => $header_value) {
				header("{$header_key}: {$header_value}", true, $code);
			}
			http_response_code($code);
			header("Status: {$status}", true, $code);
			return $this;
		}

		public function renderMeta()
		{
			$metas_content = "";
			foreach ($this->response->getMeta() as $metas) {
				$metas_content .= "\t\t<meta";
				foreach ($metas as $key => $value) {
					$metas_content .= " {$key}=\"{$value}\"";
				}
				$metas_content .= " />" . PHP_EOL;
			}
			return __($metas_content);
		}

		public function renderTitle()
		{
			$titles_array = array_diff(array_reverse($this->response->getTitle()), array(''));

			$title_content = "<title>";
			$title_content .= implode(' ' . Config::templates('title_delimiter') . ' ', $titles_array);
			$title_content .= "</title>" . PHP_EOL;
			return __($title_content);
		}

		public function renderForm(array $form_content, $form_file_name = 'assets/forms/simple_form')
		{
			$form_file = get_root_theme($form_file_name . '.html.php');
			if (file_exists($form_file)) {
				return $this->render($form_file, $form_content);
			}
			return null;
		}

		public function renderField(array $attributes, array $options, array $errors, $fields_dir = 'assets/forms/fields')
		{
			$field_type = $attributes['type'];
			$field_path = get_root_theme($fields_dir . "/" . $field_type . ".html.php");
			if (file_exists($field_path)) {
				return $this->render($field_path, array(
					'attributes' => $attributes,
					'options' => $options,
					'errors' => $errors,
				));
			}
			return null;
		}

		public function array2Attributes(array $attributes)
		{
			$attributes_string = '';
			foreach ($attributes as $name => $attribute) {
				if (!$attribute) {
					continue;
				}
				if (equal($name, 'value')) {
					$attributes_string .= $name . '="' . (is_array($attribute) ? '' : htmlspecialchars($attribute)) . '" ';
					continue;
				}
				$attributes_string .= "{$name}=\"{$attribute}\" ";
			}
			return $attributes_string;
		}

		public function renderWidgets()
		{
			$this->widgets = Widgets::getInstance();
			return $this->widgets;
		}

		public function setRenderType($render_type)
		{
			$this->render_type = $render_type;
			return $this;
		}

		public function getRenderType()
		{
			return $this->render_type;
		}
	}