<?php

	namespace Controllers\Home\Console\Controller;

	use Controllers\Home\Console\Database\DB;
	use Core\Classes\Console\Paint\Paint;
	use Core\Classes\Controller\Installer;

	class Install
	{
		protected $controller;
		protected $installer_class;

		public function __construct()
		{
			$maker = new DB();
			$maker->make();
		}

		public function execute($controller)
		{
			$this->controller = $controller;
			$this->installer_class = "\\Controllers\\{$this->controller}\\Installer\\Install";
			if (class_exists($this->installer_class)) {
				/** @var Installer $installer_instance */
				$installer_instance = new $this->installer_class;
				foreach (get_class_methods($this->installer_class) as $method) {
					if (equal($method, '__construct')) {
						continue;
					}
					call_user_func(array($installer_instance, $method));
					Paint::string(lang('Home.cli.class_method_called', array(
						'%class%' => $this->installer_class,
						'%method%' => $method
					)))->fonGreen()->print();
				}
				return $this;
			}
			return false;
		}
	}