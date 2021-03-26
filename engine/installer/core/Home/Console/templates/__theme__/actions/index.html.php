<?php

	use Core\Classes\Render;

	/** @var Render $this */
	/**
	 * @var string $file
	 * @var array $content
	 */
	$this->appendCSS('controllers/__controller_ns__/styles/index');
	$this->appendJS('controllers/__controller_ns__/scripts/index');
?>
<div class="__controller_ns__ __controller_ns__-__action_ns__">
	<div class="title bb-title mb-2">
		<h1>
			<?php __(lang('__controller_ns__.action.__action_c___title')) ?>
		</h1>
	</div>
	<?php __('simple __action_ns__ &mdash; __controller_ns__') ?>
</div>
