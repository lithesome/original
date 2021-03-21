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

	$this->appendCSS('controllers/__controller_ns__/styles/index');
	$this->appendJS('controllers/__controller_ns__/scripts/index');

?>