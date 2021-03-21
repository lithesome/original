<?php

	namespace Controllers\Home\Render\Link;

	use Core\Classes\Render;
	use Controllers\Home\Render\Link\Traits\Attributes;
	use Controllers\Home\Render\Link\Interfaces\Common;
	use Controllers\Home\Render\Link\Interfaces\Href;

	/**
	 * Class Builder
	 * @package Controllers\Home\Render\Link
	 * @method static |Href external()
	 * @method static |Href internal()
	 *
	 * Пример усложнения простейшего
	 * -----------------------------
	 * Производительность:
	 *    Для 1 000 итераций
	 *        время - 0.0241 сек
	 *        память - 5,58 кб
	 */
	class Builder implements Common
	{
		use Attributes;

		protected $external = false;

		protected $value;

		protected $hash;

		protected $attributes = array(
			'href' => '',
			'class' => 'link',
			'target' => '',
			'id' => '',
			'title' => '',
			'download' => '',
			'hreflang' => '',
			'media' => '',
			'ping' => '',
			'referrerpolicy' => '',
			'rel' => '',
			'type' => '',
			'style' => array(),
		);

		protected $request_params = array();

		protected $render;

		public static function __callStatic($name, $arguments)
		{
			return new self(equal($name, 'external'));
		}

		public function __construct($external)
		{
			$this->external = $external;
			$this->render = Render::getInstance();
		}

		public function href($router_key, ...$router_params)
		{
			$this->attributes['href'] = array(
				'key' => $router_key,
				'params' => $router_params
			);
			return $this;
		}

		public function hash($link_hash)
		{
			$this->hash = $link_hash;
			return $this;
		}

		public function class($value)
		{
			$this->attributes['class'] = $value;
			return $this;
		}

		public function style($key, $value)
		{
			$this->attributes['style'][$key] = $value;
			return $this;
		}

		public function id($value)
		{
			$this->attributes['id'] = $value;
			return $this;
		}

		public function title($value)
		{
			$this->attributes['title'] = $value;
			return $this;
		}

		public function download($value)
		{
			$this->attributes['download'] = $value;
			return $this;
		}

		public function hreflang($value)
		{
			$this->attributes['hreflang'] = $value;
			return $this;
		}

		public function media($value)
		{
			$this->attributes['media'] = $value;
			return $this;
		}

		public function ping($value)
		{
			$this->attributes['ping'] = $value;
			return $this;
		}

		public function attr($attribute_key, $attribute_value)
		{
			$this->attributes[$attribute_key] = $attribute_value;
			return $this;
		}

		public function referrerpolicy()
		{
			return new ReferrerPolicy($this);
		}

		public function target()
		{
			return new Target($this);
		}

		public function rel()
		{
			return new Rel($this);
		}

		public function type($value)
		{
			$this->attributes['type'] = $value;
			return $this;
		}

		public function value($value)
		{
			$this->value = $value;
			return $this->title($value);
		}

		public function param($get_param_key, $get_param_value)
		{
			$this->request_params[$get_param_key] = $get_param_value;
			return $this;
		}

		public function get()
		{
			$attributes = $this->attributes;
			$attributes['href'] = uri($attributes['href']['key'], ...$attributes['href']['params']);
			if ($attributes['href']) {
				if ($this->request_params) {
					$attributes['href'] = make_link_query($attributes['href'], $this->request_params, false);
				}
				if ($this->hash) {
					$attributes['href'] = $attributes['href'] . '#' . $this->hash;
				}
				if ($this->external) {
					$attributes['href'] = external($attributes['href']);
				}
				$attributes['style'] = $this->makeStylesString($attributes['style']);

				$link = '<a ';
				$link .= $this->render->array2Attributes($attributes);
				$link = trim($link);
				$link .= '>';
				$link .= $this->value;
				$link .= '</a>';
				return $link;
			}
			return null;
		}

		public function print()
		{
			return __($this->get());
		}

		protected function makeStylesString($attributes)
		{
			$styles = '';
			foreach ($attributes as $key => $value) {
				$styles .= "{$key}:{$value};";
			}
			return $styles;
		}
	}