<?php

	namespace Core\Interfaces\Forms;

	use Core\Classes\Forms\Validator;

	interface Form
	{
		/**
		 * @return self
		 */
		public function getFieldsAttributes();

		/**
		 * @return self
		 */
		public function getFieldsOptions();

		/**
		 * @param $field_name
		 * @return self
		 */
		public function field($field_name);

		/**
		 * @param $field_name
		 * @param $attribute
		 * @return self
		 */
		public function getFieldAttribute($field_name, $attribute);

		/**
		 * @param $field_name
		 * @param $attribute
		 * @return self
		 */
		public function getFieldOption($field_name, $attribute);

		/**
		 * @param $field_name
		 * @return self
		 */
		public function getFieldErrors($field_name);

		/**
		 * @param $key
		 * @param $value
		 * @return self
		 */
		public function setFieldOption($key, $value);

		/**
		 * @param $key
		 * @param $value
		 * @return self
		 */
		public function setFieldAttribute($key, $value);

		/**
		 * @param $field_name
		 * @param $value
		 * @return self
		 */
		public function setFieldError($field_name, $value);

		/**
		 * @param $key
		 * @param $value
		 * @return self
		 */
		public function setFormAttribute($key, $value);

		/**
		 * @return self
		 */
		public function getFormAttributes();

		/**
		 * @return self
		 */
		public function getErrors();

		/**
		 * @return self
		 */
		public function can();

		/**
		 * @return self
		 */
		public function renderForm();

		/**
		 * @param string $validator_class
		 * @return Validator
		 */
		public function validate($validator_class = Validator::class);
	}