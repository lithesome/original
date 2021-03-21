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

	$attributes['type'] = 'text';
?>
<div class="form-group">
	<?php if ($errors) { ?>
		<div class="errors">
			<?php foreach ($errors as $error) { ?>
				<div class="error">
					<?php __($error) ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if (isset($options['label'])) { ?>
		<label for="<?php __($attributes['id']) ?>">
			<?php if ($attributes['required']) { ?>
				<span class="required">
					<span class="text-danger">
						*
					</span>
				</span>
			<?php } ?>
			<?php __($options['label']) ?>
		</label>
	<?php } ?>

	<div class="input-group">
		<div class="input-group-prepend position-relative">
			<img style="cursor: pointer;height: 38px;" src="<?php __($options['image']) ?>"
				 onclick="indexObject.getNewCaptcha(this, '<?php __(uri('home_get_new_captcha')) ?>')"/>
		</div>
		<input class="form-control" <?php __($this->array2Attributes($attributes)) ?>>
	</div>

	<?php if (isset($options['description'])) { ?>
		<small id="" class="form-text text-muted"><?php __($options['description']) ?></small>
	<?php } ?>
</div>