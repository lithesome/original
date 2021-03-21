<?php

	namespace Controllers\Home\Hooks;

	use Core\Classes\Config;
	use Core\Classes\Router\Router;
	use Core\Classes\Response\Response;
	use Controllers\Home\Access as AccessClass;

	/**
	 * Сначала проверяются группы доступа контрроллера,
	 * если все плохо - статус 403
	 * Затем - проверяются доступы экшина,
	 * так же - статус 403, в случае провала
	 *
	 * Пустой массив групп - выходим из проверки (статус предыдущий (возможно 200))
	 *
	 * Приоритетов проверки доступа нету. Если доступ закрыт для группы - 403, даже если доступ открыт для этой группы.
	 * И точно так же набоорот: если доступ открыт для этой группы - норм, если закрыт - 403
	 *
	 * Class Access
	 * @package Controllers\Home\Hooks
	 */
	class Access extends AccessClass
	{
		private $router;
		private $response;

		private $controller;
		private $action_access;

		public function __construct()
		{
			$this->router = Router::getInstance();
			$this->response = Response::getInstance();

			$this->controller = $this->router->getControllerName();
			$this->action_access = $this->router->getRoute('access');
		}

		public function execute()
		{
			$controller_access = Config::get($this->controller, 'controller_access');
			if ($controller_access) {
				if (!$this->checkAccessGranted($controller_access) || $this->checkAccessDenied($controller_access)) {
					$this->response->setCode(403);
				}
			}
			if ($this->action_access) {
				if (!$this->checkAccessGranted($this->action_access) || $this->checkAccessDenied($this->action_access)) {
					$this->response->setCode(403);
				}
			}
			return $this;
		}
	}