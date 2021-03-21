<?php

	use Core\Classes\Render;

	/**
	 * @var Render $this
	 * @var array $data
	 * @var array $content
	 * @var array $total
	 * @var array $limit
	 * @var array $offset
	 * @var array $link
	 */

	$offset = (int)$offset;

	$current = (int)floor($offset / $limit);

	if ($total - $limit > $limit) {
		$last = $total - $limit;
	} else {
		$last = $limit;
	}

	$this->appendCSS('styles/paginate');

?>
<nav class="paginate">
	<ul class="pagination justify-content-center">
		<li class="page-item<?php __((!$offset ? ' disabled active' : '')) ?>">
			<a class="page-link" href="<?php __($link) ?>">
				<span aria-hidden="true"><?php __(lang('Home.widget.paginate_first_page')) ?></span>
			</a>
		</li>
		<?php for ($i = -1; $i < 6; $i++) { ?>
			<?php if ($i <= 0) {
				continue;
			} ?>
			<?php if (!$current) { ?>
				<?php $new_offset = $offset + $limit * ($i) ?>
				<?php if (!equal($new_offset, $offset)) { ?>
					<li class="page-item<?php __(($total <= $new_offset ? ' disabled' : '')) ?>">
						<a class="page-link" href="<?php __(make_link_query($link, array('offset' => $new_offset))) ?>">
							<?php __($current + $i + 1) ?>
						</a>
					</li>
				<?php } else { ?>
					<li class="page-item active">
						<a class="page-link">
							<?php __($current + $i + 1) ?>
						</a>
					</li>
				<?php } ?>
			<?php } ?>

			<?php if (equal($current, 1)) { ?>
				<?php $new_offset = $offset + $limit * ($i - 1) ?>
				<?php if (!equal($new_offset, $offset)) { ?>
					<li class="page-item<?php __(($total <= $new_offset ? ' disabled' : '')) ?>">
						<a class="page-link" href="<?php __(make_link_query($link, array('offset' => $new_offset))) ?>">
							<?php __($current + ($i)) ?>
						</a>
					</li>
				<?php } else { ?>
					<li class="page-item active">
						<a class="page-link">
							<?php __($current + ($i)) ?>
						</a>
					</li>
				<?php } ?>
			<?php } ?>

			<?php if (equal($current, 2)) { ?>
				<?php $new_offset = $offset + $limit * ($i - 2) ?>
				<?php if (!equal($new_offset, $offset)) { ?>
					<li class="page-item<?php __(($total <= $new_offset ? ' disabled' : '')) ?>">
						<a class="page-link" href="<?php __(make_link_query($link, array('offset' => $new_offset))) ?>">
							<?php __($current + ($i - 1)) ?>
						</a>
					</li>
				<?php } else { ?>
					<li class="page-item active">
						<a class="page-link">
							<?php __($current + ($i - 1)) ?>
						</a>
					</li>
				<?php } ?>
			<?php } ?>

			<?php if ($current > 2) { ?>
				<?php $new_offset = $offset + $limit * ($i - 3) ?>
				<?php if (!equal($new_offset, $offset)) { ?>
					<li class="page-item<?php __(($total <= $new_offset ? ' disabled' : '')) ?>">
						<a class="page-link" href="<?php __(make_link_query($link, array('offset' => $new_offset))) ?>">
							<?php __($current + ($i - 2)) ?>
						</a>
					</li>
				<?php } else { ?>
					<li class="page-item active">
						<a class="page-link">
							<?php __($current + ($i - 2)) ?>
						</a>
					</li>
				<?php } ?>
			<?php } ?>
		<?php } ?>

		<li class="page-item<?php __(($last <= $offset ? ' disabled' : '')) ?>">
			<a class="page-link" href="<?php __(make_link_query($link, array('offset' => $last))) ?>">
				<span aria-hidden="true"><?php __(lang('Home.widget.paginate_last_page', array(
						'%last_page%' => /*'(' . ceil($total / $limit) . ')'*/
							''
					))) ?></span>
			</a>
		</li>
	</ul>
</nav>