<?php

	use Core\Classes\Render;

	/** @var Render $this */
	/**
	 * @var array $content
	 * @var array $links
	 * @var string $current_key
	 * @var string $sort
	 */
?>
<ul class="nav nav-tabs nav-fill sorting-panel mb-2">
	<?php foreach ($links as $key => $action) { ?>

		<?php if (equal($key, $current_key)) { ?>
			<li class="nav-item sorting-panel-item">
				<?php if (equal('asc', $sort)) { ?>
					<a class="sorting-link"
					   href="<?php __(make_link_query($action['url'], array('sorting' => 'desc'))) ?>">
						<span class="nav-link active">
							<?php __($action['value']) ?>
							<i class="fas fa-angle-down"></i>
						</span>
					</a>
				<?php } else { ?>
					<a class="sorting-link"
					   href="<?php __(make_link_query($action['url'], array('sorting' => 'asc'))) ?>">
						<span class="nav-link active">
							<?php __($action['value']) ?>
							<i class="fas fa-angle-up"></i>
						</span>
					</a>
				<?php } ?>
			</li>
		<?php } else { ?>
			<li class="nav-item">
				<a class="nav-link" title=""
				   href="<?php __(make_link_query($action['url'], array('sorting' => $sort))) ?>">
					<?php __($action['value']) ?>
				</a>
			</li>
		<?php } ?>
	<?php } ?>
</ul>