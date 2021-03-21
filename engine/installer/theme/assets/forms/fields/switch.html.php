<?php

	use Core\Classes\Render;

	/** @var Render $this */
	/**
	 * @var string $file
	 * @var array $content
	 * @var array $attributes
	 * @var array $options
	 * @var array $errors
	 */

	if (isset($attributes['value']) && !empty($attributes['value'])) {
		$attributes['checked'] = true;
	}
	$attributes['type'] = 'checkbox';

?>
<div class="switch mb-4">

	<?php if ($errors) { ?>
		<div class="errors">
			<?php foreach ($errors as $error) { ?>
				<div class="error">
					<?php __($error) ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<div class="custom-control custom-switch">
		<input class="custom-control-input" <?php __($this->array2Attributes($attributes)) ?>>

		<?php if (isset($options['label'])) { ?>
			<label class="custom-control-label" for="<?php __($attributes['id']) ?>">
				<?php if ($attributes['required']) { ?>
					<span class="errors">
					<span class="error">
						*
					</span>
				</span>
				<?php } ?>
				<?php __($options['label']) ?>
			</label>
		<?php } ?>

	</div>

	<?php if (isset($options['description'])) { ?>
		<small id="" class="form-text text-muted"><?php __($options['description']) ?></small>
	<?php } ?>
</div>