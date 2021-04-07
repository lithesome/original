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
	 * @var string $position
	 * @var string $template
	 * @var integer $relevance
	 * @var array $arguments
	 */

	$this->appendCSS('controllers/Home/styles/index');
	$this->appendJS('controllers/Home/scripts/index');

?><a href="/" class="logo link col d-none d-lg-block" style="max-width:70px">
	<div class="icon">
		<i class="fas fa-home" aria-hidden="true"></i>
	</div>
</a>
