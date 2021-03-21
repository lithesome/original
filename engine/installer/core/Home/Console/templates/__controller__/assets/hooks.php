<?php

	use Core\Classes\Hooks\Hooks;
	use Core\Interfaces\Hooks\Maker;

	/**
	 * @example
	 * $maker = new \Core\Classes\Hooks\Maker();
	 * $maker->class(\Controllers\__controller_ns__\Controller::class);
	 * Hooks::setHook('start_system_before', $maker->getHooks());
	 *
	 * @example
	 * Hooks::register('start_system_before_0', (new \Core\Classes\Hooks\Maker())
	 *    ->class(\Controllers\__controller_ns__\Controller::class)
	 *    ->getHooks()
	 * );
	 *
	 * @example
	 * Hooks::register('start_system_before_1', function(Maker $hook){
	 *    $hook->class(\Controllers\__controller_ns__\Controller::class);
	 * });
	 */