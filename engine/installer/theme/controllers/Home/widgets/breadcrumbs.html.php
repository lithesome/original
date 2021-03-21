<?php

	use Core\Classes\Render;
	use Core\Classes\Config;

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

	$this->appendCSS('controllers/Home/styles/index');
	$this->appendJS('controllers/Home/scripts/index');

	$title_delimiter = Config::templates('breadcrumbs_delimiter');

	if (!$content) {
		return false;
	}
?>
<div class="breadcrumbs">
	<?php foreach ($content as $index => $crumb) { ?>
		<?php if (!equal('main', $index)) {
			__(" {$title_delimiter} ");
		} ?>
		<a href="<?php __($crumb['link']) ?>" class="col">
			<?php if ($crumb['icon']) { ?>
				<i class="<?php __($crumb['icon']) ?>"></i>
			<?php } ?>
			<?php __($crumb['value']) ?>
		</a>
	<?php } ?>
</div>