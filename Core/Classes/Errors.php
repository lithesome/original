<?php

	namespace Core\Classes;

	use Core\Classes\Console\Paint\Paint;

	class Errors
	{
		protected static $critical_error;

		public $error_number, $error_message, $error_file, $error_line, $backtrace = array(), $error_type, $query;
		protected $available_codes = array(1, 2, 4, 8, 16, 32, 64, 128, 256, 512, 1024, 2048, 4096, 8192, 16384, 32767);
		protected $log_file = 'tmp/logs/php_errors.php';
		protected $debug_error_file = 'assets/errors/debug_message.html.php';
		protected $critical_error_file = 'assets/errors/critical_error.html.php';

		public static function saveError($error_number, $error_message, $error_file, $error_line, $query = null)
		{
			$self = new self(...func_get_args());
			return $self->updateError();
		}

		public static function except($error_number, $error_message, $error_file, $error_line, $query = null)
		{
			$self = new self(...func_get_args());
			unset($self->backtrace[0], $self->backtrace[1]);
			if (self::$critical_error) {
				unset($self->backtrace[2]);
			}
			$self->renderError();
			return $self;
		}

		public static function saveDown()
		{
			if (@is_array($e = @error_get_last())) {
				$code = isset($e['type']) ? $e['type'] : 0;
				$msg = isset($e['message']) ? $e['message'] : '';
				$file = isset($e['file']) ? $e['file'] : '';
				$line = isset($e['line']) ? $e['line'] : '';
				if ($code > 0) {
					self::$critical_error = true;
					return self::saveError($code, $msg, $file, $line, null);
				}
			}
			return false;
		}

		public static function shutDown()
		{
			if (@is_array($e = @error_get_last())) {
				$code = isset($e['type']) ? $e['type'] : 0;
				$msg = isset($e['message']) ? $e['message'] : '';
				$file = isset($e['file']) ? $e['file'] : '';
				$line = isset($e['line']) ? $e['line'] : '';
				if ($code > 0) {
					self::$critical_error = true;
					return self::except($code, $msg, $file, $line, null);
				}
			}
			return false;
		}

		public function __construct($error_number, $error_message, $error_file, $error_line, $query = null)
		{
			if (!is_string($query)) {
				$query = null;
			}

			restore_error_handler();
			ignore_user_abort(true);

			$this->error_number = $error_number;
			$this->error_message = $error_message;
			$this->error_file = $error_file;
			$this->error_line = $error_line;
			$this->query = $query;
			$this->backtrace = debug_backtrace();
			$this->error_type = self::getErrorType($this->error_number, $this->available_codes);
			$this->log_file = get_root_path($this->log_file);
		}

		public function __destruct()
		{
			ignore_user_abort(false);
		}

		protected function updateError()
		{
			$error_key = md5($this->error_number . $this->error_message . $this->error_file . $this->error_line);
			$error_data = array();
			if (file_exists($this->log_file)) {
				$error_file = include $this->log_file;
				$error_data = is_array($error_file) ? $error_file : $error_data;
			}
			$error_data[$error_key] = array(
				'number' => $this->error_number,
				'message' => $this->error_message,
				'file' => $this->error_file,
				'line' => $this->error_line,
				'date' => time(),
				'count' => (isset($error_data[$error_key]['count']) ? $error_data[$error_key]['count'] : 0) + 1,
			);
			file_put_contents($this->log_file, php_encode($error_data));
			return $error_key;
		}

		protected function renderError()
		{
			if (is_cli()) {
				$this->renderCli();
				die();
			}
			if (Config::core('debug')) {
				http_response_code(500);
				$this->renderHtml();
				die();
			}
			if (self::$critical_error) {
				http_response_code(500);
				$this->renderHtmlCriticalError();
			}
			$this->updateError();
		}

		protected function renderCli()
		{
			Paint::string(' ' . mb_strtoupper($this->error_type) . " ")->fonRed()->print("\t");
			Paint::string(' ' . $this->error_message . " ")->fonYellow()->print("\t");
			Paint::string(' ' . $this->error_file . " ")->fonMagenta()->print("\t", ', ');
			Paint::string(' ' . $this->error_line . " ")->fonCyan()->print();
			if ($this->query) {
				Paint::string(' ' . $this->query . " ")->fonRed()->colorWhite()->print();
			}
			return $this;
		}

		protected function renderHtml()
		{
			include get_root_theme($this->debug_error_file);
			return $this;
		}

		protected function renderHtmlCriticalError()
		{
			include get_root_theme($this->critical_error_file);
			return $this;
		}

		public static function getErrorType($error_number, array $available_error_codes)
		{
			if (in_array($error_number, $available_error_codes)) {
				return lang("Home.error.error_code_{$error_number}");
			}
			return lang("Home.error.error_code", array(
				'%error_code%' => $error_number
			));
		}

		public function errorGetFileContent($error_file, $error_line)
		{
			$result_content = '<code><ol>';
			if (file_exists($error_file)) {
				$content = file($error_file);
				for ($i = $error_line - 10; $i < $error_line; $i++) {
					if (!isset($content[$i])) {
						continue;
					}
					$result_content .= '<li value="' . ($i + 1) . '" class="content-line';
					if (equal($i + 1, $error_line)) {
						$result_content .= " bg-danger text-white error-string";
					}
					$result_content .= '">';
					$result_content .= htmlspecialchars($content[$i]);
					$result_content .= '</li>';
				}
				for ($i = $error_line; $i < $error_line + 10; $i++) {
					if (!isset($content[$i])) {
						continue;
					}
					$result_content .= '<li value="' . ($i + 1) . '" class="content-line';
					$result_content .= '">';
					$result_content .= htmlspecialchars($content[$i]);
					$result_content .= '</li>';
				}
			}
			$result_content .= '</ol></code>';
			return $result_content;
		}
	}