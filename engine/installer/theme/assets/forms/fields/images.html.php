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

	$attributes['type'] = 'file';

?>
<div class="form-group" id="images-form-field">
	<?php if ($errors) { ?>
		<div class="errors">
			<?php foreach ($errors as $error) { ?>
				<div class="error">
					<?php __($error) ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<div class="preview-image mb-2 row<?php __($attributes['value'] ? '' : ' d-none') ?>">
		<?php if ($attributes['value']) { ?>
			<?php foreach ($attributes['value'] as $value) { ?>
				<div class="col mb-2" onclick="formObject.removeImage(this)">
					<div class="image-item d-inline-block position-relative">
						<input type="hidden" data-url="<?php __($options['remove_link']) ?>"
							   name="<?php __($attributes['name']) ?>[]" value="<?php __($value) ?>">
						<a class="close">
							<span>×</span>
						</a>
						<div class="image">
							<img src="<?php __($attributes['value']) ?>">
						</div>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>

	<label for="<?php __($attributes['id']) ?>" class="btn btn-general">
		<?php if ($attributes['required']) { ?>
			<span class="errors">
					<span class="error">
						*
					</span>
				</span>
		<?php } ?>
		<?php __($options['label']) ?>
	</label>

	<input multiple accept="<?php __($attributes['accept']) ?>" data-name="<?php __($attributes['name']) ?>" type="file"
		   data-action="<?php __($options['upload_link']) ?>" id="<?php __($attributes['id']) ?>"
		   class="form-control-file d-none">

	<?php if (isset($options['description'])) { ?>
		<small id="" class="form-text text-muted"><?php __($options['description']) ?></small>
	<?php } ?>
</div>