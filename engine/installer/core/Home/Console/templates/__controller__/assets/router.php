<?php

	use Core\Classes\Router\Router;
	use Core\Interfaces\Router\Maker;

	/**
	 * ---------------------------------------------------------
	 * - ЭТО ОЗНАКОМИТЕЛЬНЫЙ КОММЕНТАРИЙ, И ЕГО МОЖНО УДАЛЯТЬ! -
	 * ---------------------------------------------------------
	 *
	 * Для метода класса Router::any() вызывать метод Maker::action() необязательно
	 * В этом случае будет проверяться существование метода класса
	 * Controller::[REQUEST_METHOD . 'Method']()
	 * В случае, если таков не будет найден - ошибка 405
	 *
	 * Если указать Maker::action() для Router::any(), то все типы
	 * REQUEST_METHOD будут жестко привязаны к этому экшину
	 *
	 * Для остальных статических REQUEST -методов класса Router, метод класса
	 * Maker::action() должен быть вызван обязательно, иначе 404.
	 *
	 * Суффикс `Method` для автоматических экшинов Controller::[REQUEST_METHOD . 'Method']()
	 * обязателен, так как, иначе класс не должен будет содержать публичных методов,
	 * во избежание произвольного вызова пользователем таких методов класса контроллера, как, например
	 *
	 * SimpleControllerClass::addMoreCoinsToMyWallet($user_id, $new_coins),
	 * где в качестве REQUEST_METHOD достаточно будет указать 'addMoreCoinsToMyWallet', и перейти по ссылке
	 * /simple/controller/link/user_id/999999999999
	 *
	 * -------------------------------------------------------------------------------
	 *
	 * Поиск проходит до первого совпадения - то есть, для
	 *
	 * Router::any('/__controller_c__', function (Maker $router) {
	 *    $router->controller(\Controllers\__controller_ns__\Controller::class);
	 * });
	 * и
	 * Router::get('/__controller_c__', function (Maker $router) {
	 *    $router->controller(\Controllers\__controller_ns__\Controller::class);
	 *    $router->action('index');
	 * });
	 *
	 * результатом будет Router::any('/__controller_c__')
	 */

	/**
	 * @example
	 * $maker = new \Core\Classes\Router\Maker('any', '/__controller_c__');
	 * $maker->controller(\Controllers\__controller_ns__\Controller::class);
	 * $maker->action('index');
	 * \Core\Classes\Router\Router::addRoute('__controller_c__', $maker->getRoute());    // ключ роута - уникальный и будет перезаписан при последующем вызове
	 *
	 * @example
	 * \Core\Classes\Router\Maker::register('any', '/__controller_c__')
	 *        ->controller(\Controllers\__controller_ns__\Controller::class)
	 *        ->action('index')
	 *        ->addRoute('__controller_c__');        // ключ роута - уникальный и будет перезаписан при последующем вызове
	 */

	Router::any('__controller_c__', '/__controller_c__', function (Maker $maker) {
		$maker->controller(\Controllers\__controller_ns__\Controller::class);
		$maker->action('index');
		$maker->status(STATUS_ACTIVE);
	});