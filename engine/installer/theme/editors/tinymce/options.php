<?php

	use Core\Classes\Render;
	use Core\Classes\Language;

	/** @var Render $this */

	/**
	 * @var string $file
	 * @var array $content
	 * @var string $name
	 * @var string $value
	 * @var string $id
	 * @var string $type
	 * @var string $editor
	 * @var string $kit
	 * @var string $data_id
	 */

	$file = get_root_theme("editors/{$editor}/kits/{$kit}.php");
	$lang = Language::getLanguageKey();
	$lang = $lang . "_" . strtoupper($lang);

	if (file_exists($file)) {
		include_once $file;
	}