<?php

	use Controllers\__controller_ns__\Config;

	Config::__controller_ns__('controller_name', '__controller_ns__.controller_name');
	Config::__controller_ns__('controller_status', STATUS_ACTIVE);
	Config::__controller_ns__('controller_system', false);
	Config::__controller_ns__('controller_author', 'Someone me');
	Config::__controller_ns__('controller_icon', 'fas fa-brain');
	Config::__controller_ns__('controller_site', '__host__');

	Config::__controller_ns__('controller_access', array(
		'granted' => array(
			'accessor' => \Core\Classes\Access\Granted::class,
			'methods' => array(
				'checkGroups' => array()
			)
		),
		'denied' => array(
			'accessor' => \Core\Classes\Access\Denied::class,
			'methods' => array(
				'checkGroups' => array()
			)
		),
	));