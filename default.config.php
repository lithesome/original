<?php

	use Core\Classes\Config;

	Config::core('crypt_key', '[encryption_key]');
	Config::core('default_language', 'ru');
	Config::core('site_locale', 'ru_RU.utf8');
	Config::core('site_scheme', '[site_scheme]');
	Config::core('site_host', '[site_host]');
	Config::core('debug', true);

	Config::database('db_driver', \Core\Classes\Database\Builder\MySQLi::class);
	Config::database('db_name', '[db_name]');

	Config::MySQLi('db_host', '[db_host]');
	Config::MySQLi('db_port', '[db_port]');
	Config::MySQLi('db_user', '[db_user]');
	Config::MySQLi('db_pass', '[db_pass]');
	Config::MySQLi('charset', 'utf8mb4');
	Config::MySQLi('collate', 'utf8mb4_unicode_ci');
	Config::MySQLi('mode', 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION');
	Config::MySQLi('locale', 'ru_RU');
	Config::MySQLi('engine', 'MyISAM');

	Config::session('session_domain', '');
	Config::session('session_name', 'sid');
	Config::session('session_time', 86400 * 100);
	Config::session('session_dir', '../html/sessions');
	Config::session('csrf_expired_time', 3600);

	Config::cache('enabled', false);
	Config::cache('driver', \Core\Classes\Cache\Drivers\JSON::class);
	Config::cache('ttl', 900);

	Config::templates('main_theme', '[main_theme]');
	Config::templates('logo', 'site/images/logo/logo.png');
	Config::templates('site_name', '[site_name]');
	Config::templates('uploads_dir', '/uploads');
	Config::templates('title_delimiter', '&rarr;');
	Config::templates('breadcrumbs_delimiter', '<i class="fas fa-long-arrow-alt-right"></i>');
	Config::templates('breadcrumbs_on_main', false);