<?php

	use Core\Classes\Cron\Cron;
	use Core\Interfaces\Cron\Maker;

	Cron::register('home_simple_task', function (Maker $cron) {
		$cron->class(\Controllers\Home\Cron\SimpleCronTask::class);
		$cron->period(10);
		$cron->status(STATUS_ACTIVE);
	});

	Cron::register('home_remove_old_sessions', function (Maker $cron) {
		$cron->class(\Controllers\Home\Cron\RemoveOldSessions::class);
		$cron->period(86400);
		$cron->status(STATUS_ACTIVE);
	});