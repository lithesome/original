<?php

	\Core\Classes\Router\Maker::any('/{str}{int}')
		->controller(\Controllers\Home\Render\Link\Builder::class)
		->addRoute('example_link');

	$link = new \Controllers\Home\Render\Link\Builder(false);

	$link->class('link user-link user');
	$link->hash('user');
	$link->rel()->nofollow();
	$link->target()->blank();

	for ($i = 0; $i < 100; $i++) {
		$link->href('example_link', 'uid', $i)
			->value('user id' . $i . ' page')
			->id('id-' . $i);

		$link->param('get', $i);

		$link->style('color', 'rgba(' . rand(1, 255) . ',' . rand(1, 255) . ', ' . rand(1, 255) . ')');

		$link->attr('onclick', 'event.preventDefault();alert(\'following canceled!\');');

		$link->print();    //	$link->get();
	}

	exit();