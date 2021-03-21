<?php

	use Core\Classes\Render;

	/** @var Render $this */
	/**
	 * @var string $file
	 * @var array $content
	 * @var string $key
	 * @var string $class
	 * @var string $title
	 * @var string $method
	 * @var integer $status
	 * @var array $options
	 * @var array $position
	 * @var string $template
	 * @var integer $relevance
	 * @var array $arguments
	 */
?>
<div
	class="widget widget-languages languages-data d-none"><?php __(htmlspecialchars(json_encode($content, JSON_UNESCAPED_UNICODE))) ?></div>
