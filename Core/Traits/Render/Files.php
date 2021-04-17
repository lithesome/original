<?php

	namespace Core\Traits\Render;

	use Core\Classes\Config;

	trait Files
	{
		private $js_files = array();
		private $css_files = array();
		private $append_js = array();
		private $append_css = array();
		private $prepend_js = array();
		private $prepend_css = array();

		public function addExternalJS($js_file_path, ...$file_suffix)
		{
			$this->js_files[$js_file_path] = $js_file_path . '.js' . implode('', $file_suffix);
			return $this;
		}

		public function appendExternalJS($js_file_path, ...$file_suffix)
		{
			$this->append_js[$js_file_path] = $js_file_path . '.js' . implode('', $file_suffix);
			return $this;
		}

		public function prependExternalJS($js_file_path, ...$file_suffix)
		{
			$this->prepend_js[$js_file_path] = $js_file_path . '.js' . implode('', $file_suffix);
			return $this;
		}

		public function addExternalCSS($css_file_path, ...$file_suffix)
		{
			$this->css_files[$css_file_path] = $css_file_path . '.css' . implode('', $file_suffix);
			return $this;
		}

		public function appendExternalCSS($css_file_path, ...$file_suffix)
		{
			$this->append_css[$css_file_path] = $css_file_path . '.css' . implode('', $file_suffix);
			return $this;
		}

		public function prependExternalCSS($css_file_path, ...$file_suffix)
		{
			$this->prepend_css[$css_file_path] = $css_file_path . '.css' . implode('', $file_suffix);
			return $this;
		}

		public function addJS($js_file_path)
		{
			$this->js_files[$js_file_path] = $this->makeFileLink($js_file_path, 'js');
			return $this;
		}

		public function addCSS($css_file_path)
		{
			$this->css_files[$css_file_path] = $this->makeFileLink($css_file_path, 'css');
			return $this;
		}

		public function appendJS($js_file_path)
		{
			$this->append_js[$js_file_path] = $this->makeFileLink($js_file_path, 'js');
			return $this;
		}

		public function appendCSS($css_file_path)
		{
			$this->append_css[$css_file_path] = $this->makeFileLink($css_file_path, 'css');
			return $this;
		}

		public function prependJS($js_file_path)
		{
			$this->prepend_js[$js_file_path] = $this->makeFileLink($js_file_path, 'js');
			return $this;
		}

		public function prependCSS($css_file_path)
		{
			$this->prepend_css[$css_file_path] = $this->makeFileLink($css_file_path, 'css');
			return $this;
		}

		public function renderJsFiles()
		{
			$this->js_files = array_merge($this->prepend_js, $this->js_files, $this->append_js);

			$js_files = '';
			foreach ($this->js_files as $key => $file) {
				$js_files .= "<script src=\"{$file}\"></script>" . PHP_EOL;
				unset($this->js_files[$key]);
			}
			__($js_files);
			return $this->dropJsFiles();
		}

		public function renderCssFiles()
		{
			$this->css_files = array_merge($this->prepend_css, $this->css_files, $this->append_css);

			$css_files = '';
			foreach ($this->css_files as $key => $file) {
				$css_files .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$file}\">" . PHP_EOL;
				unset($this->css_files[$key]);
			}
			__($css_files);
			return $this->dropCssFiles();
		}

		protected function dropCssFiles()
		{
			$this->append_css = array();
			$this->prepend_css = array();
			return $this;
		}

		protected function dropJsFiles()
		{
			$this->prepend_js = array();
			$this->append_js = array();
			return $this;
		}

		protected function makeFileLink($file_path, $file_extension)
		{
			$version = Config::core('debug') ? TIME : date(Config::templates('files_version_date_format'));
			$file_extension = "{$file_extension}?v=" . $version;
			$file_path = trim($file_path, '/');
			$file_path = "{$file_path}.{$file_extension}";
			return get_http_theme("/{$file_path}");
		}

	}