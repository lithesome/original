<?php

	use Controllers\__controller_ns__\Config;
	use Core\Classes\Access\Accessor;

	Config::__controller_ns__('controller_name', '__controller_ns__.controller_name');
	Config::__controller_ns__('controller_status', STATUS_ACTIVE);
	Config::__controller_ns__('controller_system', false);
	Config::__controller_ns__('controller_author', 'Someone me');
	Config::__controller_ns__('controller_icon', 'fas fa-brain');
	Config::__controller_ns__('controller_site', '__host__');

	/*Config::__controller_ns__('controller_access', Accessor::granted()
		->checkGroups(\Controllers\Auth\Groups::CONDITIONAL_GROUP_ADMIN)
		->access('denied')
		->checkGroups(\Controllers\Auth\Groups::CONDITIONAL_GROUP_UNAUTH)
		->getParams()
	);*/