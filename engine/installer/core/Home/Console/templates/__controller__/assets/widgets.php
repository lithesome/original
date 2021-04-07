<?php
	/**
	 * @default-positions
	 *    header_items
	 *    content_top
	 *    sidebar
	 *    content_up
	 *    before_content
	 *        --- not pos ---
	 *            content
	 *        --- not pos ---
	 *    after_content
	 *    content_down
	 *    content_bottom
	 *    footer
	 *    zzz_last_pos
	 */

	use Core\Classes\Widgets\Widgets;
	use Core\Interfaces\Widgets\Maker;

	/**
	 * @example
	 * Widgets::register('header', function(Maker $widget){
	 *    $widget->class(\Controllers\__controller_ns__\Controller::class);
	 *    $widget->method('someWidget');
	 *    $widget->template('__controller_ns__/widgets/some_widget');
	 * });
	 *
	 * @example
	 * $widget = new \Core\Classes\Widgets\Maker();
	 * $widget->class(\Controllers\__controller_ns__\Controller::class);
	 * $widget->method('someWidget');
	 * $widget->template('__controller_ns__/widgets/some_widget');
	 * Widgets::setWidget('header', $widget->getWidget());
	 */