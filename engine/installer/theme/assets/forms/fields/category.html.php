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

	$attributes['type'] = 'hidden';

?>
<div class="form-group select-block field-<?php __($attributes['name']) ?>">
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
				<span class="errors">
					<span class="error">
						*
					</span>
				</span>
			<?php } ?>
			<?php __($options['label']) ?>
		</label>
	<?php } ?>

	<div class="form-control input select-field" contenteditable="true"></div>

	<div class="d-none select-options col-12 p-1" data-name="<?php __($attributes['name']) ?>">
		<?php foreach ($options['select_options'] as $option) { ?>
			<div<?php if (isset($attributes['value'][$option['id']])) { ?> style="display:none" <?php } ?>
				data-value="<?php __($option['id']) ?>" data-parent="<?php __($option['parent_id']) ?>" class="item p-2"
				onclick="formObject.selectVariant(this);$(this).hide()">
				<?php __($option['title']) ?>
			</div>
		<?php } ?>
	</div>

	<div class="col-12">
		<div class="row selected-variants">
			<?php if ($attributes['value']) { ?>
				<?php foreach ($attributes['value'] as $value) { ?>
					<div class="col btn btn-light m-1"
						 onclick="$(this).remove();$('.field-<?php __($attributes['name']) ?> [data-value=<?php __($value['id']) ?>]').show();">
						<input data-id="<?php __($value['id']) ?>" type="hidden" class="form-control category"
							   name="<?php __($attributes['name']) ?>[<?php __($value['id']) ?>]"
							   value="<?php __($value['title']) ?>">
						<a class="close">
							<span>×</span>
						</a>
						<?php __($value['title']) ?>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>

	<?php if (isset($options['description'])) { ?>
		<small class="form-text text-muted"><?php __($options['description']) ?></small>
	<?php } ?>
</div>