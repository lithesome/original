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

	$this->appendCSS('controllers/Home/styles/scrollbar');
	$this->appendJS('controllers/Home/scripts/scrollbar');

?>
<div class="scroll-bar position-fixed modified-bar" style="display:none;" onclick="scrollObject.upToTopClick()">
	<div id="up" style="">
		<div class="top-up-icon">
			<i class="fas fa-angle-up"></i>
		</div>
		<div class="top-up-content"></div>
	</div>
	<div id="down" style="display: none;">
		<div class="top-up-content"></div>
		<div class="top-up-icon">
			<i class="fas fa-angle-down"></i>
		</div>
	</div>
</div>
