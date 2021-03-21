<?php

	use Core\Classes\Console\Console;
	use Core\Interfaces\Console\Maker;

	Console::register('make:controller', function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\Controller::class);
		$command->command('make:controller[ controller [ ...actions]]');
		$command->example('make:controller Simple');
		$command->example('make:controller Simple Index Item Add Edit Remove');
		$command->description('Home.cli.make_controller_with_actions');
	});

	Console::register("help", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Help\Help::class);
		$command->command('help[ --pretty| -p]');
		$command->example('help');
		$command->example('help -p');
		$command->example('help --pretty');
		$command->description('Home.cli.help_simple_print');
	});

	Console::register("help:cmd", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Help\Help::class);
		$command->command('help:cmd[ command]');
		$command->method('runCommandHelp');
		$command->example('help:cmd make');
		$command->description('Home.cli.help_command_print');
	});

	Console::register("server:run", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Server\Server::class);
		$command->command('server:run[ host=127.0.0.1 [:port=8080 [server_file=server.php]]]');
		$command->example('server:run');
		$command->example('server:run 192.168.0.101');
		$command->example('server:run 192.168.0.101:8088');
		$command->example('server:run 192.168.0.101:8088 my_custom_server_file.php');
		$command->description('Home.cli.server_run');
	});

	Console::register("cron:run", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Cron\Cron::class);
		$command->command('cron:run');
		$command->example('cron:run');
		$command->description('Home.cli.cron_run');
	});

	Console::register("make:db", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Database\DB::class);
		$command->method('make');
		$command->command('make:db[ db_name=false]');
		$command->example('make:db');
		$command->example('make:db simple_db');
		$command->description('Home.cli.make_db');
	});

	Console::register("drop:db", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Database\DB::class);
		$command->method('drop');
		$command->command('drop:db[ db_name=false]');
		$command->example('drop:db');
		$command->example('drop:db simple_db');
		$command->description('Home.cli.drop_db');
	});

	Console::register("make:widget {controller}:{widget}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\Widget::class);
		$command->command('make:widget[ controller[:widget]]');
		$command->example('make:widget Home:Menu');
		$command->description('Home.cli.make_widget');
	});

	Console::register("make:class {class_path}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\CreateClass::class);
		$command->mask('([a-z0-9\-\_\\\\\]+)');
		$command->command('make:class[ ClassName]');
		$command->example('make:class Name\\\\Space\\\\ClassName');
		$command->description('Home.cli.make_class');
	});

	Console::register("make:cmd {controller}:{command}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\ConsoleCommand::class);
		$command->mask('([a-z0-9\-\_\/]+)');
		$command->command('make:cmd[ controller[:command]]');
		$command->example('make:cmd Home:Server');
		$command->example('make:cmd Home:Directory/Server');
		$command->description('Home.cli.make_console_command');
	});

	Console::register("make:cron {controller}:{cron}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\CronTask::class);
		$command->command('make:cron[ controller[:cron]]');
		$command->example('make:cron Home:SomeCronTask');
		$command->description('Home.cli.make_cron_task');
	});

	Console::register("make:form {controller}:{form}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\Form::class);
		$command->command('make:form[ controller[:form]]');
		$command->example('make:form Home:RegistrationForm');
		$command->description('Home.cli.make_form');
	});

	Console::register("make:hook {controller}:{hook}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\Hook::class);
		$command->command('make:hook[ controller[:hook]]');
		$command->example('make:hook Home:SomeoneHook');
		$command->description('Home.cli.make_hook');
	});

	Console::register("make:test {controller}:{test}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\Test::class);
		$command->command('make:test[ controller[:test]]');
		$command->example('make:test Home:SomeoneTestClass');
		$command->description('Home.cli.make_test');
	});

	Console::register("controller:install {controller}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Controller\Install::class);
		$command->command('controller:install[ controller]');
		$command->example('controller:install Auth');
		$command->description('Home.cli.controller_install');
	});

	Console::register("controller:remove {controller}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Controller\Delete::class);
		$command->command('controller:remove[ controller]');
		$command->example('controller:remove Auth');
		$command->description('Home.cli.controller_remove');
	});

	Console::register("controller:update {controller}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Controller\Update::class);
		$command->command('controller:update[ controller]');
		$command->example('controller:update Auth');
		$command->description('Home.cli.controller_update');
	});

	Console::register("controller:upgrade {controller}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Controller\Upgrade::class);
		$command->command('controller:upgrade[ controller]');
		$command->example('controller:upgrade Auth');
		$command->description('Home.cli.controller_upgrade');
	});

	Console::register("run:code", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Run\Code::class);
		$command->command('run:code[ \'php_code\']');
		$command->example('run:code \'return "OK";\'; ');
		$command->description('Home.cli.run_code');
	});

	Console::register("test:run", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Test\Run::class);
		$command->command('test:run');
		$command->example('test:run');
		$command->description('Home.cli.test_run');
	});

	Console::register("test:run -t", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Test\Run::class);
		$command->method('makeTemporaryDatabase');
		$command->command('test:run -t');
		$command->example('test:run -t');
		$command->description('Home.cli.test_run_temporary');
	});

	Console::register("make:db_driver {db_driver}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Database\CreateDatabaseDriver::class);
		$command->command('make:db_driver[ db_driver]');
		$command->example('make:db_driver MySQL_PDO');
		$command->description('Home.cli.make_db_driver');
	});

	Console::register("make:model {controller}:{model_name}", function (Maker $command) {
		$command->controller(\Controllers\Home\Console\Make\Model::class);
		$command->command('make:model[ model_name]');
		$command->example('make:model Home:CategoriesModel');
		$command->description('Home.cli.make_model');
	});
