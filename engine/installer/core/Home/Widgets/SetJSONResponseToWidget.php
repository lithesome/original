<?php

	namespace Controllers\Home\Widgets;

	use Core\Classes\Language;
	use Core\Classes\Widgets\Widget;

	class SetJSONResponseToWidget extends Widget
	{
		private $language;

		public function __construct()
		{
			$this->language = Language::getInstance();
		}

		public function setLanguages()
		{
			$this->setParam('content', $this->language->getAllControllersLanguages(Language::getLanguageKey()));
			return $this;
		}
	}