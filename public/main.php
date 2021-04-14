<?php

	use Core\Classes\Response\Response;
	use Core\Classes\Session\Session;
	use Core\Classes\Router\Router;
	use Core\Classes\Hooks\Hooks;
	use Core\Classes\Language;
	use Core\Classes\Request;
	use Core\Classes\Render;
	use Core\Classes\Server;
	use Core\Classes\Config;

	require __DIR__ . '/../gateway.php';

	$hooks = Hooks::getInstance();
	$hooks->before('system_start');

	$config = Config::getInstance();
	$hooks->before('config_set');
	$config->setConfigs();
	$hooks->after('config_set');

	$request = Request::getInstance();
	$hooks->before('request_set');
	$request->setRequestUri(Server::get('REQUEST_URI'));
	$request->setRequestQuery(Server::get('REQUEST_URI'));
	$request->setRequestMethod(Server::get('REQUEST_METHOD'));
	$request->setRequestArray($_REQUEST);
	$request->setHeadersArray(getallheaders());
	$hooks->after('request_set');

	$hooks->before('response_set');
	$response = Response::getInstance();
	$hooks->after('response_set');

	$session = Session::getInstance();
	$hooks->before('session_start');
	$session->start();
	$hooks->after('session_start');

	$hooks->before('language_set');
	$language = Language::getInstance();
	$hooks->after('language_set');

	$router = Router::getInstance();
	$hooks->before('search_url');
	$router->searchCurrentUrl();
	$hooks->after('search_url');
	$router->runController();

	$render = Render::getInstance();
	$hooks->before('render_start');
	$render->startRendering();
	$hooks->after('render_start');

	$hooks->after('system_start');
