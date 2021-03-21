<?php

	namespace Controllers\Home\Console\Run;
	/**
	 * Class Code
	 * @package Controllers\Home\Console\Run
	 * @example 'print_r('ok')'        => error
	 * @example 'print_r("ok")'        => ok
	 * @example "print_r("ok")"        => error
	 * @example "print_r('ok')"        => ok
	 * @example 'print_r(\'ok\')'    => error
	 * @example "print_r(\"ok\")"    => error
	 */
	class Code
	{
		public function __construct()
		{
		}

		public function execute($php_code)
		{
			eval($php_code . ';');
			__(PHP_EOL);
			return $this;
		}
	}