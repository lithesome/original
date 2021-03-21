<?php

	use Core\Classes\Console\Console;
	use Core\Interfaces\Console\Maker;

	/**
	 * @example
	 * Console::register('simple:command {param}', function(Maker $command){
	 * $command->controller(\Controllers\__controller_ns__\Controller::class);
	 * $command->command('simple:command[ param]');
	 * $command->description('__controller_ns__.cli.simple_command_description');
	 * $command->example('simple:command true');                            // префикс `php cli ` добавляется автоматически
	 * });
	 *
	 * @example
	 * \Core\Classes\Console\Maker::register('some:command')
	 * ->controller(\Controllers\__controller_ns__\Controller::class)
	 * ->command('simple:command[ param]')
	 * ->description('__controller_ns__.cli.simple_command_description')
	 * ->example('simple:command true')                                    // префикс `php cli ` добавляется автоматически
	 * ->description('__controller_ns__.cli.simple_command_description')
	 * ->addCommand();
	 *
	 * @example
	 * $maker = new \Core\Classes\Console\Maker('simple:cmd');
	 * $maker->controller(\Controllers\__controller_ns__\Controller::class);
	 * $maker->command('simple:command[ param]');
	 * $maker->description('__controller_ns__.cli.simple_command_description');
	 * $maker->example('simple:command true');                                    // префикс `php cli ` добавляется автоматически
	 * Console::addCommand($maker->getCommand());
	 */
