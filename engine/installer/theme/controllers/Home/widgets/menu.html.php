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
	$this->appendCSS('controllers/Home/styles/menu');
?>
<div class="list-group menu<?php __(isset($options['menu_class']) ? ' ' . $options['menu_class'] : '') ?>">
	<?php if (isset($options) && isset($options['menu_head'])) { ?>
		<div class="sidebar-widget-head <?php __(isset($options['head_class']) ? $options['head_class'] : '') ?>">
			<?php __($options['menu_head']) ?>
		</div>
	<?php } ?>
	<?php foreach ($content as $link) { ?>
		<a href="<?php __($link['link']) ?>">
			<div class="menu-value row">
				<?php if ($link['icon']) { ?>
					<i class="icon <?php __($link['icon']) ?> col-2"></i>
				<?php } ?>
				<div class="col-10">
					<?php __($link['value']) ?>
				</div>
			</div>
		</a>
	<?php } ?>
</div>