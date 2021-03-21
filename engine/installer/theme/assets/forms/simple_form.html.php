<?php

	use Core\Classes\Render;

	/** @var Render $this */
	/**
	 * @var string $file
	 * @var array $content
	 * @var array $form
	 * @var array $fields
	 * @var array $options
	 * @var array $errors
	 */

	$this->appendCSS('styles/form');
	$this->appendJS('scripts/form');

	if (!isset($form)) {
		return false;
	}

?>
<form <?php __($this->array2Attributes($form)) ?>>

	<?php if (isset($errors['form'])) { ?>
		<div class="errors">
			<?php foreach ($errors['form'] as $error) { ?>
				<div class="error">
					<?php __($error) ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php foreach ($fields as $name => $field) { ?>
		<?php __($this->renderField($field, isset($options[$name]) ? $options[$name] : array(), isset($errors[$name]) ? $errors[$name] : array())) ?>
	<?php } ?>

	<div class="form-group send-form-button">
		<button type="submit" class="btn btn-primary"><?php __(lang('Home.field.form_button_send')) ?></button>
	</div>
</form>
