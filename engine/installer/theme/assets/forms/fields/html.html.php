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

	$options['unique'] = $attributes['data-unique'] = md5(number_format(microtime(1), 10));

	__($this->render(get_root_theme("editors/{$options['editor']}/options.php"), array_merge($attributes, $options)));

	$attributes['data-id'] = $options['editor'] . '-' . $options['kit'];

	$value = $attributes['value'];
	unset($attributes['value']);

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
				<span class="errors">
					<span class="error">
						*
					</span>
				</span>
			<?php } ?>
			<?php __($options['label']) ?>
		</label>
	<?php } ?>

	<?php if(isset($attributes['required'])){ unset($attributes['required']); } ?>

	<textarea class="form-control" <?php __($this->array2Attributes($attributes)) ?>><?php ___($value) ?></textarea>

	<?php if (isset($options['description'])) { ?>
		<small id="" class="form-text text-muted"><?php __($options['description']) ?></small>
	<?php } ?>
</div>