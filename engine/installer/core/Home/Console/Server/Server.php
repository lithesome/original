<?php

	namespace Controllers\Home\Console\Server;

	use Core\Classes\Console\Paint\Paint;

	class Server
	{
		protected $host_and_port;
		protected $file;

		public function __construct()
		{
		}

		public function execute($host_and_port = '127.0.0.1:8080', $server_file = 'server.php')
		{
			$this->host_and_port = $host_and_port;
			$this->file = $server_file;
			$this->runSever();
			return true;
		}

		public function runSever()
		{
			if (!function_exists('passthru')) {
				die('function "passthru()" not exists!' . PHP_EOL);
			}
			$this->success($this->host_and_port);
			passthru("/usr/bin/env php -S {$this->host_and_port} {$this->file}");
			return $this->error();
		}

		protected function success($address)
		{
			Paint::string(lang('Home.cli.server_running_success', array(
				'%date%' => date('d F Y'),
				'%time%' => date('H:i:s'),
				'%zone%' => date('e'),
			)))->fonYellow()->print(null, '...' . PHP_EOL);

			Paint::string(lang('Home.cli.server_success_text'))->fonGreen()->print(null, '...' . PHP_EOL);

			Paint::string(lang('Home.cli.server_success_details'))->fonMagenta()->print(null, ' ');

			Paint::string(lang('Home.cli.server_success_address', array(
				'%host%' => $address
			)))->fonCyan()->print(null, '...' . PHP_EOL . PHP_EOL);

			Paint::string(lang('Home.cli.server_leave'))->fonRed()->print(null, '...' . PHP_EOL);

			return $this;
		}

		protected function error()
		{
			Paint::string(lang('Home.cli.server_running_failed', array(
				'%date%' => date('d F Y'),
				'%time%' => date('H:i:s'),
				'%zone%' => date('e'),
			)))->fonRed()->print(null, '...' . PHP_EOL);

			Paint::string(lang('Home.cli.server_failed_text'))->fonMagenta()->print(null, '...' . PHP_EOL);

			return $this;
		}
	}