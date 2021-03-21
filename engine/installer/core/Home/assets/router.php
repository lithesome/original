<?php

	use Core\Classes\Router\Router;
	use Core\Interfaces\Router\Maker;

	Router::any('home_main', '/', function (Maker $router) {
		$router->controller(\Controllers\Home\Controller::class);
		$router->action('index');
		$router->status(STATUS_ACTIVE);
	});

	Router::get('home_get_new_captcha', '/home/getCaptcha', function (Maker $maker) {
		$maker->controller(\Controllers\Home\Controller::class);
		$maker->action('getNewCaptcha');
		$maker->status(STATUS_ACTIVE);
	});