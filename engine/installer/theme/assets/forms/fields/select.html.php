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
	if (isset($attributes['multiple']) && !empty($attributes['multiple'])) {
		$attributes['name'] = $attributes['name'] . '[]';
	}

?>
<div class="form-group select-block">
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

	<select class="form-control" <?php __($this->array2Attributes($attributes)) ?>>
		<option class="empty" value><?php __(lang('Home.field.empty_option_position')) ?></option>
		<?php foreach ($options['select_options'] as $key => $option) { ?>
			<?php $selected = equal($key, $attributes['value']) || (is_array($attributes['value']) && in_array($key, $attributes['value'])) ?>
			<option value="<?php __($key) ?>" <?php if ($selected) { ?> selected<?php } ?>><?php __($option) ?></option>
		<?php } ?>
	</select>

	<?php if (isset($options['description'])) { ?>
		<small id="" class="form-text text-muted"><?php __($options['description']) ?></small>
	<?php } ?>
</div>