<?php

	use Core\Classes\Render;

	/** @var Render $this */
	/**
	 * @var string $file
	 * @var array $content
	 * @var string $int
	 * @var string $str
	 */
	$this->appendCSS('controllers/Home/styles/index');
	$this->appendJS('controllers/Home/scripts/index');
?>
<div class="Home Home-item col-12">
	int: <?php __($int) ?><br>
	str: <?php __($str) ?>
</div>
