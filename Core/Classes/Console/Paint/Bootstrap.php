<?php

	namespace Core\Classes\Console\Paint;

	/**
	 * Class Bootstrap
	 * @package Core\Classes\Console\Paint\Bootstrap
	 *
	 * @method static danger($string, $before = null, $after = PHP_EOL)
	 * @method static success($string, $before = null, $after = PHP_EOL)
	 * @method static warning($string, $before = null, $after = PHP_EOL)
	 * @method static primary($string, $before = null, $after = PHP_EOL)
	 * @method static purple($string, $before = null, $after = PHP_EOL)
	 * @method static poison($string, $before = null, $after = PHP_EOL)
	 */
	class Bootstrap
	{
		private static $static = array(
			'danger' => array(
				'color' => null,
				'fon' => '41',
			),
			'success' => array(
				'color' => null,
				'fon' => '42',
			),
			'warning' => array(
				'color' => null,
				'fon' => '43',
			),
			'primary' => array(
				'color' => null,
				'fon' => '44',
			),
			'purple' => array(
				'color' => null,
				'fon' => '45',
			),
			'poison' => array(
				'color' => null,
				'fon' => '46',
			),
		);

		public static function __callStatic($name, $arguments)
		{
			if (isset(self::$static[$name])) {
				$paint = new Paint($arguments[0]);
				if (self::$static[$name]['color']) {
					$paint->setColor(self::$static[$name]['color']);
				}
				if (self::$static[$name]['fon']) {
					$paint->setFon(self::$static[$name]['fon']);
				}
				unset($arguments[0]);
				$paint->print(...$arguments);
				return true;
			}
			return false;
		}
	}