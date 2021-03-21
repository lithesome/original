<?php

	namespace Core\Classes\Access;

	use Core\Classes\Session\Session;
	use Core\Interfaces\Access\Granted as GrantedInterface;

	/**
	 * Class Granted
	 * @package Core\Classes\Access
	 * @description
	 * Функциональность класса отличается от класса Core\Classes\Access\Denied тем,
	 * что по-умолчанию все можно, до первого запрета, дальше доступы не проверяются.
	 * То есть, если вызывать по-очереди методы checkControllers(), checkUrlMasks(), checkGroups()
	 * в любой последовательности, если, допустим checkGroups() установил запрет, остальные методы
	 * больше не проверяют доступ
	 */
	class Granted extends Access implements GrantedInterface
	{
		protected $access = true;

		public function __construct()
		{
			parent::__construct();
		}

		/**
		 * @param array $controllers
		 * @example $controllers = array(
		 *        'Home' => array(
		 *            'index','item','add','remove'
		 *        ),
		 *        'Some' => array(
		 *            'index','item','add','remove'
		 *        ),
		 * )
		 * @return $this
		 */
		public function checkControllers(array $controllers)
		{
			if ($controllers) {
				if (!$this->access) {
					return $this;
				}
				foreach ($controllers as $controller => $actions) {
					$this->access = false;
					if (equal($controller, $this->controller)) {
						if (!$actions || in_array($this->action, $actions)) {
							$this->access = true;
							break;
						}
					}
				}
			}
			return $this;
		}

		/**
		 * @param array $uris_masks
		 * @example $uris_masks = array('/','/home','/home/{int}/{str}')
		 * @return $this
		 */
		public function checkUrlMasks(array $uris_masks)
		{
			if ($uris_masks) {
				if (!$this->access) {
					return $this;
				}
				foreach ($uris_masks as $mask) {
					$this->access = false;
					if ($this->checkUrlMask(trim($mask, '/'))) {
						$this->access = true;
						break;
					}
				}
			}
			return $this;
		}

		public function checkGroups(array $groups)
		{
			if ($groups) {
				if (!$this->access) {
					return $this;
				}
				$user_groups = Session::auth('groups') ?: array(1);
				foreach ($groups as $group) {
					$this->access = false;
					if (in_array($group, $user_groups)) {
						$this->access = true;
						break;
					}
				}
			}
			return $this;
		}

		public function can()
		{
			return $this->access;
		}
	}