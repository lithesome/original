<?php

	use Core\Classes\Hooks\Hooks;
	use Core\Interfaces\Hooks\Maker;

	Hooks::register('run_controller_before', function (Maker $hook) {
		$hook->class(\Controllers\Home\Hooks\Controller::class);
		$hook->method('checkControllerStatus');
		$hook->status(STATUS_ACTIVE);
	});

	Hooks::register('run_controller_before', function (Maker $hook) {
		$hook->class(\Controllers\Home\Hooks\Access::class);
		$hook->status(STATUS_ACTIVE);
	});

	Hooks::register('render_start_before', function (Maker $hook) {
		$hook->class(\Controllers\Home\Hooks\Response::class);
		$hook->method('renderAllWidgets');
		$hook->status(STATUS_ACTIVE);
	});

	Hooks::register('search_url_after', function (Maker $hook) {
		$hook->class(\Controllers\Home\Hooks\Response::class);
		$hook->method('setResponse');
		$hook->status(STATUS_ACTIVE);
	});

	Hooks::register('system_start_after', function (Maker $hook) {
		$hook->class(\Controllers\Home\Hooks\Session::class);
		$hook->status(STATUS_ACTIVE);
	});

	Hooks::register('system_start_after', function (Maker $hook) {
		$hook->class(\Controllers\Home\Hooks\LogUserActivity::class);
		$hook->status(STATUS_INACTIVE);
	});