<?php

	use Core\Classes\Cron\Cron;
	use Core\Interfaces\Cron\Maker;

	/**
	 * @example
	 * $maker = new \Core\Classes\Cron\Maker('simple_task');
	 * $maker->class(\Controllers\__controller_ns__\Controller::class);
	 * $maker->period(3600);
	 * Cron::addCronTask($maker->getCronTasks());
	 *
	 * @example
	 * \Core\Classes\Cron\Maker::register('some_one_cron_task')
	 *    ->class(\Controllers\__controller_ns__\Controller::class)
	 *    ->period(3600)
	 *    ->addTask();
	 *
	 * @example
	 * Cron::register('home_simple_task', function (Maker $cron) {
	 *    $cron->class(\Controllers\__controller_ns__\Cron\SimpleCronTask::class);
	 *    $cron->period(10);
	 *    $cron->status(STATUS_ACTIVE);
	 * });
	 */
