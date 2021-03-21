<?php

	use Core\Classes\Render;

	/** @var Render $this */

	$this->appendCSS('styles/errors');
	$this->appendJS('scripts/errors');

?>
<div class="container">
	<div class="row justify-content-center error text-center error-405">
		<div class="error-head col-12"><?php __(lang('Home.error.error_head')) ?></div>
		<div class="error-code col-12">
			405
		</div>
		<div class="error-description col-12"><?php __(lang('Home.error.error_405', array(
				'%method%' => strtoupper($this->request->getRequestMethod())
			))) ?></div>
	</div>
</div>