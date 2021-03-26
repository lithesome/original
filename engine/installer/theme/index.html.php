<?php

use Core\Classes\Render;
use Core\Classes\Language;
use Core\Classes\Widgets\Widgets;

/** @var Render $this */

$this->addExternalJS('https://code.jquery.com/jquery-3.6.0.min');
$this->addExternalJS('https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min');
$this->addExternalJS('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min');
$this->addExternalCSS('https://pro.fontawesome.com/releases/v5.10.0/css/all');
$this->addExternalCSS('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min');

$this->addCSS('styles/index');
$this->addCSS('styles/header');
$this->addJS('scripts/libraries/functions');
$this->addJS('scripts/index');

?><!DOCTYPE html>
<html lang="<?php __(Language::getLanguageKey()) ?>">
<head>
	<?php $this->renderTitle() ?>
	<?php $this->renderMeta() ?>
	<?php $this->renderCssFiles() ?>
	<?php $this->renderJsFiles() ?>
</head>
<body class="<?php __($this->router->getControllerName()) ?>-controller">
<?php if (!$this->widgets->empty('header_items')) { ?>
	<header class="container header p-0">
		<div class="row container p-0 m-0">
			<div class="col-12 header-items">
				<div class="row">
					<?php __($this->widgets->get('header_items')) ?>
				</div>
			</div>
		</div>
	</header>
<?php } ?>
<?php if (!$this->widgets->empty('content_top')) { ?>
	<div class="container content-top mt-2">
		<?php __($this->widgets->get('content_top')) ?>
	</div>
<?php } ?>
<main class="container body mt-2">
	<div class="row justify-content-center">
		<?php if (!$this->widgets->empty('sidebar')) { ?>
			<div class="sidebar-panel col-3 pr-2 d-none d-lg-block">
				<div class="sidebar">
					<?php __($this->widgets->get('sidebar')) ?>
				</div>
			</div>
		<?php } ?>
		<div class="content-position col-12<?php if (!$this->widgets->empty('sidebar')) { ?> col-lg-9<?php } ?> p-0">
			<?php if (!$this->widgets->empty('content_up')) { ?>
				<div class="content-up mb-2">
					<?php __($this->widgets->get('content_up')) ?>
				</div>
			<?php } ?>

			<div class="content">
				<?php if (!$this->widgets->empty('before_content')) { ?>
					<?php __($this->widgets->get('before_content')) ?>
				<?php } ?>
				<?php __($this->getContent()) ?>
				<?php if (!$this->widgets->empty('after_content')) { ?>
					<?php __($this->widgets->get('after_content')) ?>
				<?php } ?>
			</div>

			<?php if (!$this->widgets->empty('content_down')) { ?>
				<div class="content-down mt-2">
					<?php __($this->widgets->get('content_down')) ?>
				</div>
			<?php } ?>
		</div>
	</div>
</main>

<?php if (!$this->widgets->empty('content_bottom')) { ?>
	<div class="container content-bottom mt-2">
		<?php __($this->widgets->get('content_bottom')) ?>
	</div>
<?php } ?>
<?php if (!$this->widgets->empty('footer')) { ?>
	<footer class="text-dark bg-white text-center text-lg-start container p-0 mt-2">
		<?php __($this->widgets->get('footer')) ?>
	</footer>
<?php } ?>
<?php if (!$this->widgets->empty('zzz_last_pos')) { ?>
	<div class="container last-widgets-position p-0">
		<?php __($this->widgets->get('zzz_last_pos')) ?>
	</div>
<?php } ?>
<?php $this->renderJsFiles() ?>
<?php $this->renderCssFiles() ?>
</body>
</html>
