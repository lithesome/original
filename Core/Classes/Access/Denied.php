<?php

	namespace Core\Classes\Access;

	use Core\Interfaces\Access\Denied as DeniedInterface;

	class Denied extends Access implements DeniedInterface
	{
		protected $access = false;

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
				foreach ($controllers as $controller => $actions) {
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
				foreach ($uris_masks as $mask) {
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
				foreach ($groups as $group) {
					if ($this->checkGroup($group)) {
						$this->access = true;
						break;
					}
				}
			}
			return $this;
		}

		public function cant()
		{
			return $this->access;
		}
	}