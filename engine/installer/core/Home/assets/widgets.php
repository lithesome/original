<?php
	/**
	 * @default-positions
	 *    header_items
	 *    content_top
	 *    sidebar
	 *    content_up
	 *    before_content
	 *    --- not pos ---
	 *    content
	 *    --- not pos ---
	 *    after_content
	 *    content_down
	 *    content_bottom
	 *    footer
	 *    zzz_last_pos
	 */

	use Core\Classes\Widgets\Widgets;
	use Core\Interfaces\Widgets\Maker;

	/*Widgets::register('header_items', function(Maker $widget){
		$widget->class(\Controllers\Home\Widgets\SimpleWidget::class);
		$widget->method('execute');
		$widget->template('controllers/Home/widgets/simple_widget');
		$widget->custom('access',array(
			'granted'	=> array(
				'accessor'	=> \Core\Classes\Access\Granted::class,
				'methods'	=> array(
					'checkGroups'		=> array(
						4
					),
					'checkControllers'	=> array(
						'Admin'	=> array(
							'Controllers'
						)
					),
					'checkUrlMasks'		=> array(
						'/market
					),
				)
			),
			'denied'	=> array(
				'accessor'	=> \Core\Classes\Access\Denied::class,
				'methods'	=> array(
					'checkGroups'		=> array(
						4
					),
					'checkControllers'	=> array(
						'Admin'	=> array(
							'Controllerss'
						)
					),
					'checkUrlMasks'		=> array(
						'/home'
					),
				)
			),
		));
	});*/

	Widgets::register('zzz_last_pos', function (Maker $widget) {
		$widget->template('controllers/Home/widgets/debug');
		$widget->relevance(999999999999);
		$widget->title('Home.widget.debug_widget_title');
		$widget->custom('access', array(
			'granted' => array(
				'accessor' => \Core\Classes\Access\Granted::class,
				'methods' => array(
					'checkGroups' => array(),
				)
			),
		));
	});

	Widgets::register('header_items', function (Maker $widget) {
		$widget->class(\Controllers\Home\Widgets\Logo::class);
		$widget->template('controllers/Home/widgets/logo');
		$widget->title('Home.widget.logo_widget_title');
		$widget->status(STATUS_ACTIVE);
		$widget->relevance(1);
	});

	Widgets::register('header_items', function (Maker $widget) {
		$widget->class(\Controllers\Home\Widgets\Logo::class);
		$widget->template('controllers/Home/widgets/sidebar_button');
		$widget->title('Home.widget.logo_widget_title');
		$widget->relevance(1);
	});

	Widgets::register('content_up', function (Maker $widget) {
		$widget->class(\Controllers\Home\Widgets\Breadcrumbs::class);
		$widget->template('controllers/Home/widgets/breadcrumbs');
		$widget->title('Home.widget.breadcrumbs_widget_title');
	});

	Widgets::register('content_down', function (Maker $widget) {
		$widget->class(\Controllers\Home\Widgets\Breadcrumbs::class);
		$widget->template('controllers/Home/widgets/breadcrumbs');
		$widget->title('Home.widget.breadcrumbs_widget_title');
	});

	Widgets::register('header_items', function (Maker $widget) {
		$widget->template('controllers/Home/widgets/scrollbar');
		$widget->title('Home.widget.scrollbar_widget_title');
	});

	Widgets::register('footer', function (Maker $widget) {
		$widget->class(\Controllers\Home\Widgets\SetJSONResponseToWidget::class);
		$widget->method('setLanguages');
		$widget->template('controllers/Home/widgets/languages');
		$widget->title('Home.widget.language_widget_title');
	});
