<?php

	namespace Core\Classes\Forms;

	use Core\Classes\Request;
	use Core\Traits\Forms\Fields;
	use Core\Classes\Response\Response;
	use Core\Interfaces\Forms\Form as FormInterface;
	use Core\Abstracts\Forms\Form as FormAbstraction;

	class Form extends FormAbstraction implements FormInterface
	{
		use Fields;

		protected $field;
		protected $form_attributes = array();
		protected $attributes = array();
		protected $options = array();
		protected $errors = array();

		/** @var Request */
		protected $request;
		/** @var Response */
		protected $response;

		public function __call($name, $arguments)
		{
			return $this->field($name);
		}

		public function __construct()
		{
			$this->request = Request::getInstance();
			$this->response = Response::getInstance();
			$this->setDefaultFormAttributes();
		}

		protected function setDefaultFormAttributes()
		{
			$this->setFormAttribute('method', 'POST');
			$this->setFormAttribute('accept-charset', 'UTF-8');
			$this->setFormAttribute('autocomplete', 'on');
			$this->setFormAttribute('enctype', 'application/x-www-form-urlencoded');
			return $this;
		}

		public function setFormAttribute($key, $value)
		{
			$this->form_attributes[$key] = $value;
			return $this;
		}

		public function getFormAttributes()
		{
			return $this->form_attributes;
		}

		public function getErrors()
		{
			return $this->errors;
		}

		public function can()
		{
			return !$this->errors;
		}

		public function renderForm()
		{
			$this->response->setContent('form', $this->form_attributes);
			$this->response->setContent('fields', $this->attributes);
			$this->response->setContent('options', $this->options);
			$this->response->setContent('errors', $this->errors);
			return $this;
		}

		/**
		 * @param string $validator_class
		 * @return Validator
		 */
		public function validate($validator_class = Validator::class)
		{
			$validator = new $validator_class($this, $this->request);
			foreach ($this->options as $field_name => $attributes) {
				foreach ($attributes as $method => $value) {
					if (method_exists($validator, $method)) {
						call_user_func(array($validator, $method), $field_name, $value);
					}
				}
			}
			return $validator;
		}
	}