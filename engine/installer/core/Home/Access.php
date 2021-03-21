<?php

	namespace Controllers\Home;

	use Core\Classes\Access\Granted;
	use Core\Classes\Access\Denied;

	class Access
	{
		public function checkAccessGranted($controller)
		{
			if (isset($controller['granted'])) {
				/** @var Granted $accessor */
				$accessor = new $controller['granted']['accessor'];
				foreach ($controller['granted']['methods'] as $method => $params) {
					call_user_func_array(array($accessor, $method), array($params));
				}
				return $accessor->can();
			}
			return true;
		}

		public function checkAccessDenied($controller)
		{
			if (isset($controller['denied'])) {
				/** @var Denied $accessor */
				$accessor = new $controller['denied']['accessor'];
				foreach ($controller['denied']['methods'] as $method => $params) {
					call_user_func_array(array($accessor, $method), array($params));
				}
				return $accessor->cant();
			}
			return false;
		}
	}