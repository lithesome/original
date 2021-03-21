<?php

	use Core\Classes\Render;

	/** @var Render $this */
	/**
	 * @var array $content
	 * @var array $links
	 * @var string $current_key
	 */
	if (count($links) <= 1) {
		return false;
	}
?>
<ul class="nav nav-tabs nav-fill header-panel mb-2">
	<?php foreach ($links as $key => $link) { ?>
		<li class="nav-item">
			<a class="nav-link<?php __(equal($key, $current_key) ? ' active disabled' : '') ?>"
			   href="<?php __($link['url']) ?>">
				<?php if ($link['icon']) { ?>
					<i class="<?php __($link['icon']) ?>"></i>
				<?php } ?>
				<?php __($link['value']) ?> (<?php __($link['total']) ?>)
			</a>
		</li>
	<?php } ?>
</ul>