<?php

	use Core\Interfaces\Test\Maker;
	use Core\Classes\Test\Test;

	/**
	 * @example
	 * $test = new \Core\Classes\Test\Maker();
	 * $test->class(\Controllers\__controller_ns__\Controller::class);
	 * $test->method('index');
	 * Test::addTest($test->getTest());
	 *
	 * @example
	 * \Core\Classes\Test\Maker::register()
	 *    ->class(\Controllers\__controller_ns__\Controller::class)
	 *    ->method('index')
	 *    ->addTest();
	 *
	 * @example
	 * Test::register(function(Maker $test){
	 *    $test->class(\Controllers\__controller_ns__\Controller::class);
	 *    $test->method('index');
	 * });
	 */