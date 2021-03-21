<?php

	\Core\Classes\Router\Maker::any('/example/{str}/{int}')
		->controller(\Controllers\Home\Render\Link\Builder::class)
		->addRoute('example_link');

	$link = \Controllers\Home\Render\Link\Builder::external()
		->href('example_link', 'simpleController', rand())
		->param('get1', array(
			1, 2, 3, 4, 5, 6, 7
		))
		->param('get2', array(
			'one' => 1, 'two' => 2, 'three' => 3, 'zero' => 0
		))
		->param('get3', 'string')
		->value('link value text content')
		->referrerpolicy()->strictOriginWhenCrossOrigin()
		->target()->blank()
		->rel()->alternate()
		->style('color', 'red')
		->style('font-size', '2em')
		->attr('onclick', 'event.preventDefault();alert(\'following canceled!\');')
		->class('link external-link non-ajax-link')
		->id('non-internal-link');

	pre($link->get());