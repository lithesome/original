<?php

	namespace Core\Traits\Forms;

	use Core\Classes\Request;
	use Core\Classes\Session\Session;
	use Core\Classes\Response\Response;
	use Core\Classes\Forms\Captcha;

	trait Fields
	{
		/** @var Request */
		protected $request;
		/** @var Response */
		protected $response;

		public function unset()
		{
			if (isset($this->attributes[$this->field])) {
				unset($this->attributes[$this->field]);
				unset($this->options[$this->field]);
				unset($this->errors[$this->field]);
				return true;
			}
			return false;
		}

		public function getFieldsAttributes()
		{
			return $this->attributes;
		}

		public function getFieldsOptions()
		{
			return $this->options;
		}

		public function field($field_name)
		{
			$this->field = $field_name;
			return $this;
		}

		public function getFieldAttribute($field_name, $attribute)
		{
			return isset($this->attributes[$field_name][$attribute]) && $this->attributes[$field_name][$attribute] ? $this->attributes[$field_name][$attribute] : null;
		}

		public function getFieldOption($field_name, $attribute)
		{
			return isset($this->options[$field_name][$attribute]) && $this->options[$field_name][$attribute] ? $this->options[$field_name][$attribute] : null;
		}

		public function getFieldErrors($field_name)
		{
			return isset($this->errors[$field_name]) && $this->errors[$field_name] ? $this->errors[$field_name] : null;
		}

		public function setFieldOption($key, $value)
		{
			$this->options[$this->field][$key] = $value;
			return $this;
		}

		public function setFieldAttribute($key, $value)
		{
			$this->attributes[$this->field][$key] = $value;
			return $this;
		}

		public function setFieldError($field_name, $value)
		{
			$this->errors[$field_name][] = $value;
			return $this;
		}

		public function csrf()
		{
			$this->field('csrf')
				->setFieldAttribute('name', 'csrf')
				->setFieldAttribute('type', 'hidden')
				->setFieldAttribute('id', 'csrf')
				->setFieldAttribute('value', encode(Session::getCSRFToken('csrf')))
				->setFieldAttribute('required', true)
				->setFieldOption('required', true)
				->setFieldOption('csrf', true);
			return $this;
		}

		public function password($field_name)
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('type', 'password')
				->setFieldAttribute('required', true)
				->setFieldOption('required', true)
				->setFieldOption('label', lang('Home.field.password_label'))
				->setFieldOption('description', lang('Home.field.password_description'))
				->setFieldOption('min', 6);
			return $this;
		}

		public function email($field_name)
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('type', 'email')
				->setFieldAttribute('required', true)
				->setFieldOption('required', true)
				->setFieldOption('label', lang('Home.field.email_label'))
				->setFieldOption('description', lang('Home.field.email_description'))
				->setFieldOption('email', true);
			return $this;
		}

		public function text($field_name)
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('type', 'text')
				->setFieldAttribute('required', false)
				->setFieldOption('required', false)
				->setFieldOption('label', lang('Home.field.text_label'))
				->setFieldOption('description', lang('Home.field.text_description'));
			return $this;
		}

		public function checkbox($field_name)
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('type', 'checkbox')
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('checked', false)
				->setFieldAttribute('required', false)
				->setFieldOption('required', false)
				->setFieldOption('label', lang('Home.field.checkbox_label'))
				->setFieldOption('description', lang('Home.field.checkbox_description'));
			return $this;
		}

		public function switch($field_name)
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('type', 'switch')
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('checked', false)
				->setFieldAttribute('required', false)
				->setFieldOption('required', false)
				->setFieldOption('label', lang('Home.field.checkbox_label'))
				->setFieldOption('description', lang('Home.field.checkbox_description'));
			return $this;
		}

		public function file($field_name, $multiple = false)
		{
			$this->field = $field_name;

			$this->setFormAttribute('method', 'POST');
			$this->setFormAttribute('enctype', 'multipart/form-data');

			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('required', false)
				->setFieldAttribute('type', 'file')
				->setFieldAttribute('multiple', $multiple)
				->setFieldAttribute('accept', false)
				->setFieldOption('multiple', $multiple)
				->setFieldOption('required', false)
				->setFieldOption('min_size', false)
				->setFieldOption('label', lang('Home.field.file_label'))
				->setFieldOption('description', lang('Home.field.file_description'))
				->setFieldOption('max_size', false);

			return $this;
		}

		public function image($field_name, $upload_link = null, $remove_link = null)
		{
			$upload_link = $upload_link ?: uri('upload_image');
			$remove_link = $remove_link ?: uri('remove_image');
			return $this->file($field_name, false)
				->setFieldAttribute('type', 'image')
				->setFieldOption('upload_link', $upload_link)
				->setFieldOption('remove_link', $remove_link)
				->setFieldAttribute('accept', '.png,.jpg,.jpeg,.bmp,.gif');
		}

		public function images($field_name, $upload_link = null, $remove_link = null)
		{
			$upload_link = $upload_link ?: uri('upload_image');
			$remove_link = $remove_link ?: uri('remove_image');
			return $this->file($field_name, true)
				->setFieldAttribute('type', 'images')
				->setFieldAttribute('accept', '.png,.jpg,.jpeg,.bmp,.gif')
				->setFieldOption('upload_link', $upload_link)
				->setFieldOption('remove_link', $remove_link)
				->setFieldOption('multiple', false);
		}

		public function select($field_name, array $options = array())
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('type', 'select')
				->setFieldAttribute('required', false)
				->setFieldOption('required', false)
				->setFieldOption('label', lang('Home.field.select_label'))
				->setFieldOption('description', lang('Home.field.select_description'))
				->setFieldOption('select_options', $options);
			return $this;
		}

		public function category($field_name, array $options = array())
		{
			return $this->select($field_name, $options)
				->setFieldAttribute('type', 'category');
		}

		public function textarea($field_name)
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('type', 'textarea')
				->setFieldAttribute('required', false)
				->setFieldOption('required', false)
				->setFieldOption('label', lang('Home.field.textarea_label'))
				->setFieldOption('description', lang('Home.field.textarea_description'));
			return $this;
		}

		/**
		 * @param $field_name
		 * @param string $kit
		 * @param string $editor
		 * @return $this
		 */
		public function html($field_name, $kit = 'post', $editor = 'tinymce')
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('type', 'html')
				->setFieldAttribute('required', false)
				->setFieldOption('required', false)
				->setFieldOption('label', lang('Home.field.html_label'))
				->setFieldOption('description', lang('Home.field.html_description'))
				->setFieldOption('editor', $editor)
				->setFieldOption('kit', $kit);
			return $this;
		}

		public function radio($field_name)
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('type', 'radio')
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('checked', false)
				->setFieldAttribute('required', false)
				->setFieldOption('required', false)
				->setFieldOption('label', lang('Home.field.radio_label'));
			return $this;
		}

		public function hidden($field_name)
		{
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('type', 'hidden')
				->setFieldAttribute('value', $this->request->query($this->field))
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('required', false)
				->setFieldOption('required', false);
			return $this;
		}

		public function captcha($field_name = 'captcha')
		{
			$captchaProvider = new Captcha();
			$this->field($field_name)
				->setFieldAttribute('name', $this->field)
				->setFieldAttribute('type', 'captcha')
				->setFieldAttribute('autocomplete', 'off')
				->setFieldAttribute('id', $this->field)
				->setFieldAttribute('required', false)
				->setFieldOption('required', false)
				->setFieldOption('image', $captchaProvider->setCaptchaImage())
				->setFieldOption('captcha', true)
				->setFieldOption('label', lang('Home.field.captcha_label'))
				->setFieldOption('description', lang('Home.field.captcha_description'));
			return $this;
		}
	}