<?php

	namespace Controllers\Home\Forms;

	use Core\Classes\Forms\Form;

	class SimpleForm extends Form
	{
		public function __construct()
		{
			parent::__construct();
			$this->csrf();
		}
	}