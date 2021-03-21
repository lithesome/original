<?php

	use Controllers\Home\Config;

	Config::Home('controller_name', 'Home.controller_name');
	Config::Home('controller_status', STATUS_ACTIVE);
	Config::Home('controller_system', false);
	Config::Home('controller_author', 'Me');
	Config::Home('controller_icon', 'fas fa-home');
	Config::Home('controller_site', 'http://my.c');

	Config::Home('controller_access', array(
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