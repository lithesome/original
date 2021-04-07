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

?><a href="javascript:void(0)" class="sidebar-button link col d-block d-lg-none" onclick="HomeObject.showSidebar()"
	 style="max-width:70px">
	<div class="icon">
		<i class="fa fa-bars" aria-hidden="true"></i>
	</div>
</a>
