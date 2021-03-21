<?php

	namespace Core\Classes\Forms;

	use Core\Classes\Request;
	use Core\Classes\Session\Session;
	use Core\Interfaces\Forms\Form;

	class Validator
	{
		/** @var Form */
		protected $form_instance;
		protected $request;

		public function __construct(Form $form_instance, Request $request)
		{
			$this->form_instance = $form_instance;
			$this->request = $request;
		}

		public function csrf($field_name, $value)
		{
			if ($value && !equal($this->request->query($field_name), encode(Session::other($field_name)))) {
				$this->form_instance->setFieldError('form', lang('Home.field.csrf_not_equal', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function required($field_name, $value)
		{
			if ($value && !$this->request->query($field_name)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_required', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function email($field_name, $value)
		{
			if ($value && $value != filter_var($this->request->query($field_name), FILTER_VALIDATE_EMAIL)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_not_mail', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function url($field_name, $value)
		{
			if ($value && $value != filter_var($this->request->query($field_name), FILTER_VALIDATE_URL)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_not_url', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function domain($field_name, $value)
		{
			if ($value && $value != filter_var($this->request->query($field_name), FILTER_VALIDATE_DOMAIN)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_not_domain', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function float($field_name, $value)
		{
			if ($value && $value != filter_var($this->request->query($field_name), FILTER_VALIDATE_FLOAT)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_not_float', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function int($field_name, $value)
		{
			if ($value && $value != filter_var($this->request->query($field_name), FILTER_VALIDATE_INT)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_not_int', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function mac($field_name, $value)
		{
			if ($value && $value != filter_var($this->request->query($field_name), FILTER_VALIDATE_MAC)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_not_mac', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function ip($field_name, $value)
		{
			if ($value && $value != filter_var($this->request->query($field_name), FILTER_VALIDATE_IP)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_not_ip', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function phone($field_name, $value)
		{
			$phone = ltrim($this->request->query($field_name), '+');
			if ($value && $phone != (int)$this->request->query($field_name)) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_not_phone', array(
					'%field%' => $field_name,
				)));
			}
			return $this;
		}

		public function min($field_name, $value)
		{
			if ($value && mb_strlen($this->request->query($field_name)) < $value) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_min_size', array(
					'%field%' => $field_name,
					'%size%' => $value,
				)));
			}
			return $this;
		}

		public function max($field_name, $value)
		{
			if ($value && mb_strlen($this->request->query($field_name)) > $value) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_max_size', array(
					'%field%' => $field_name,
					'%size%' => $value,
				)));
			}
			return $this;
		}

		public function html_min($field_name, $value)
		{
			if ($value && mb_strlen(strip_tags($this->request->query($field_name))) < $value) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_min_size', array(
					'%field%' => $field_name,
					'%size%' => $value,
				)));
			}
			return $this;
		}

		public function html_max($field_name, $value)
		{
			if ($value && mb_strlen(strip_tags($this->request->query($field_name))) > $value) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.field_max_size', array(
					'%field%' => $field_name,
					'%size%' => $value,
				)));
			}
			return $this;
		}

		public function multiple($field_name, $value)
		{
			$files_validator = new Files($this->form_instance, $field_name);
			if ($value) {
				$files_validator->validateMultiple();
			} else {
				$files_validator->validateSingle();
			}
			$_FILES[$field_name] = $files_validator->getFiles();
			return $this;
		}

		public function captcha($field_name = 'captcha', $value = true)
		{
			if ($value && !equal(Session::system($field_name), strtolower($this->request->query($field_name)))) {
				$this->form_instance->setFieldError($field_name, lang('Home.field.captcha_error'));
			}
			return $this;
		}
	}