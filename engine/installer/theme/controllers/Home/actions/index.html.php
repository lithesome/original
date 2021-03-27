<?php

	use Core\Classes\Render;

	/** @var Render $this */
	/**
	 * @var string $file
	 * @var array $content
	 * @var string $hello_world
	 */
	$this->appendCSS('controllers/Home/styles/index');
	$this->appendJS('controllers/Home/scripts/index');
?>
<div class="Home Home-index d-flex" style="height: 100%">
	<h1 class="m-auto" style="font-size: 20vh">
		<?php __($hello_world) ?>
	</h1>
</div>
