<?php

	namespace Core\Abstracts\Forms;

	use Core\Classes\Forms\Validator;

	abstract class Form
	{
		abstract public function getFieldsAttributes();

		abstract public function getFieldsOptions();

		abstract public function field($field_name);

		abstract public function getFieldAttribute($field_name, $attribute);

		abstract public function getFieldOption($field_name, $attribute);

		abstract public function getFieldErrors($field_name);

		abstract public function setFieldOption($key, $value);

		abstract public function setFieldAttribute($key, $value);

		abstract public function setFieldError($field_name, $value);

		abstract public function setFormAttribute($key, $value);

		abstract public function getFormAttributes();

		abstract public function getErrors();

		abstract public function can();

		abstract public function renderForm();

		abstract public function validate($validator_class = Validator::class);
	}