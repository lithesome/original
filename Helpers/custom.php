<?php

	use Core\Classes\Language;
	use Core\Classes\Config;
	use Core\Classes\Router\Router;
	use Core\Classes\Request;
	use Controllers\Home\Access;
	use Core\Classes\Session\Session;

	define('STATUS_INACTIVE', 0);
	define('STATUS_ACTIVE', 1);
	define('STATUS_DELETED', 2);
	define('STATUS_LOCKED', 3);
	define('STATUS_BLOCKED', 4);

	function is_cli()
	{
		return defined('CLI') && !defined('FAKE_CONSOLE');
	}

	function pre(...$_)
	{
		restore_error_handler();
		__(is_cli() ? PHP_EOL : '<pre>');
		foreach ($_ as $item) {
			print_r($item);
			__(is_cli() ? PHP_EOL : '<hr>');
		}
		die(is_cli() ? PHP_EOL : '</pre>');
	}

	function dd(...$_)
	{
		__(is_cli() ? PHP_EOL : '<pre>');
		foreach ($_ as $item) {
			var_dump($item);
			__(is_cli() ? PHP_EOL : '<hr>');
		}
		die(is_cli() ? PHP_EOL : '</pre>');
	}

	function __($string)
	{
		print $string;
		return null;
	}

	function ___($string)
	{
		return __(htmlspecialchars($string));
	}

	function equal($a, $b)
	{
		return $a === $b;
	}

	function broken($a, $b)
	{
		return !equal($a, $b);
	}

	function get_root_uploads($path)
	{
		$path = ltrim($path, '/');
		return ROOT_PUBLIC . Config::templates('uploads_dir') . '/' . $path;
	}

	function get_http_uploads($path)
	{
		$path = ltrim($path, '/');
		return HTTP_PUBLIC . Config::templates('uploads_dir') . '/' . $path;
	}

	function get_root_public($path)
	{
		$path = ltrim($path, '/');
		return ROOT_PUBLIC . '/' . $path;
	}

	function get_http_public($path)
	{
		$path = ltrim($path, '/');
		return HTTP_PUBLIC . '/' . $path;
	}

	function get_root_templates($path)
	{
		$path = ltrim($path, '/');
		return ROOT_TEMPLATES . '/' . $path;
	}

	function get_http_templates($path)
	{
		$path = ltrim($path, '/');
		return HTTP_TEMPLATES . '/' . $path;
	}

	function get_root_theme($path)
	{
		$path = ltrim($path, '/');
		$path = Config::templates('main_theme') . '/' . $path;
		return get_root_templates($path);
	}

	function get_http_theme($path)
	{
		$path = ltrim($path, '/');
		$path = Config::templates('main_theme') . '/' . $path;
		return get_http_templates($path);
	}

	function xml_encode(array $data, $tab = "\t", $old_tab = "", $tag_prefix = "item"): string
	{
		$result = '';
		foreach ($data as $key => $val) {
			$empty_var = empty($val);
			$key = !is_numeric($key) ? $key : "{$tag_prefix}";
			$key = str_replace(array(
				' ', '/', '.', ',', '\\', '=', '-', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '\'', '"', ':', ';', '?', '>', '<',
			), '_', $key);
			if (is_array($val)) {
				$result .= $tab . "<{$key}>" . ($empty_var ? '' : PHP_EOL);
				$result .= $old_tab . xml_encode($val, "{$tab}{$tab}", $old_tab);
				$result .= ($empty_var ? "NULL" : $tab) . "</{$key}>" . PHP_EOL;
			} else
				if (is_object($val)) {
					$val = json_decode(json_encode($val), 1);
					$result .= $tab . "<{$key}>" . ($empty_var ? '' : PHP_EOL);
					$result .= $old_tab . xml_encode($val, "{$tab}{$tab}", $old_tab);
					$result .= ($empty_var ? "NULL" : $tab) . "</{$key}>" . PHP_EOL;
				} else {
					$result .= $tab . "<{$key}>";
					$result .= ($empty_var ? "NULL" : htmlspecialchars($val));
					$result .= "</{$key}>" . PHP_EOL;
				}
		}
		return $result;
	}

	function php_encode($content, $remove_objects = true,
						$replace_pattern = array(
							"#([0-9]+) => \n  #",
							"#([0-9]+) => #",
							"#'([A-Za-z_]+)' => \n#",
							"#array \(\n +\)#",
							"#=>  +#",
							"#  #"
						),
						$replacement = array(
							'',
							'',
							'\'$1\' => ',
							'array ()',
							'=> ',
							"\t"
						)
	)
	{
		$remove_objects_recursive = function ($content, callable $self_function) {
			if (is_array($content)) {
				foreach ($content as $key => $value) {
					if (is_object($value)) {
						$content[$key] = array();
					}
					if (is_array($value)) {
						$content[$key] = $self_function($value, $self_function);
					}
				}
			}
			return !is_object($content) ? $content : array();
		};
		$content = !$remove_objects ? $content : $remove_objects_recursive($content, $remove_objects_recursive);

		$content = var_export($content, true);
		if ($replace_pattern) {
			$content = preg_replace($replace_pattern, $replacement, $content);
		}
		$result = "<?php";
		$result .= "\n";
		$result .= "return ";
		$result .= trim($content, ',');
		$result .= ";";
		return $result;
	}

	/**
	 * @param string $content
	 * @return mixed
	 */
	function php_decode($content)
	{
		$content = ltrim($content, '<?php');
		return eval($content . ";");
	}

	function lang($lang_key, $replace_data = array(), $not_found = true)
	{
		$keys = explode('.', $lang_key, 2);
		if (isset($keys[0]) && isset($keys[1])) {
			$language_result_string = Language::getInstance()->getLanguageValue($keys[0], $keys[1]);
			if ($language_result_string) {
				if ($replace_data) {
					return str_replace(array_keys($replace_data), array_values($replace_data), $language_result_string);
				}
			}
			return $language_result_string;
		}
		return $not_found ? $lang_key : $not_found;
	}

	function gen($length = 32)
	{
		$symbols = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
		$gen = '';
		for ($i = 0; $i < $length; $i++) {
			$gen .= $symbols[rand(0, 61)];
		}
		return $gen;
	}

	function make_dir($dir_path, $chmod = 0775, $recursive = true)
	{
		if (!is_dir($dir_path)) {
			mkdir($dir_path, $chmod, $recursive);
			return true;
		}
		return false;
	}

	function scan_dir_recursive_callback($directory_path, callable $callback, ...$params)
	{
		$directory_path = rtrim($directory_path, '/');
		if (is_dir($directory_path) && is_readable($directory_path)) {
			foreach (scandir($directory_path) as $file_or_folder) {
				if ($file_or_folder == '.' || $file_or_folder == '..') {
					continue;
				}
				if (!scan_dir_recursive_callback("{$directory_path}/{$file_or_folder}", $callback)) {
					call_user_func($callback, "{$directory_path}/{$file_or_folder}", ...$params);
				}
			}
		}
		return false;
	}

	function encode($decode_value)
	{
		$crypt_key = Config::core('crypt_key');
		return encodeSha512(
			encodeHaval2565(
				encodeSha384(encodeHaval2563($crypt_key . $decode_value . $crypt_key) . $decode_value) .
				encodeSha512(encodeHaval2564($decode_value . $crypt_key . $decode_value) . $crypt_key)
			) .
			encodeHaval2564(
				encodeSha512(encodeHaval1923($crypt_key . $decode_value . $crypt_key) . $decode_value) .
				encodeSha384(encodeHaval1924($decode_value . $crypt_key . $crypt_key) . $decode_value)
			)
		);
	}

	function prepare_memory($memory, $decimals = 2, $dec_point = ',', $thousands_sep = '')
	{
		$memory = abs($memory);
		switch ($memory) {
			case ($memory < 1024):
				$memory = number_format($memory / 1, $decimals, $dec_point, $thousands_sep);
				return $memory . "b";
			case ($memory < 1048576):
				$memory = number_format($memory / 1024, $decimals, $dec_point, $thousands_sep);
				return $memory . "kb";
			case ($memory < 1073741824):
				$memory = number_format($memory / 1048576, $decimals, $dec_point, $thousands_sep);
				return $memory . "mb";
			case ($memory < 1099511627776):
				$memory = number_format($memory / 1073741824, $decimals, $dec_point, $thousands_sep);
				return $memory . "gb";
			case ($memory < 1125899906842624):
				$memory = number_format($memory / 1099511627776, $decimals, $dec_point, $thousands_sep);
				return $memory . "tb";
			default:
				$memory = number_format($memory / 1125899906842624, $decimals, $dec_point, $thousands_sep);
				return $memory . "pb";
		}
	}

	/**
	 * Создать ссылку по уникальному ключу роута.
	 * Так же проверить права доступа к ссылке.
	 * Если права разрешены и не запрещены - возвращает (string) ссылку, или (null)
	 *
	 * 09.04.2021: замено {(.*?)} на ({(.*?)}|\((.*?)\)) для роутов с "жестким" шаблоном (/([a-z]+), /([0-9]+) и т.д.)
	 *
	 * @param $route_key
	 * @param array ...$params
	 * @return null|string
	 *
	 * @test pre(uri('admin_controller_action', 'Main', 'active'));
	 */
	function uri($route_key, ...$params)
	{
		$routes = Router::getRoutesRawList();
		if (isset($routes[$route_key])) {
			$router = $routes[$route_key];
			$controller = Router::prepareControllerName($router['controller']);
			
			$controller_status = Config::get($controller, 'controller_status');
			$controller_access = Config::get($controller, 'controller_access');
			$route_access = isset($router['access']) ? $router['access'] : array();

			if (access($controller_access) && access($route_access) && equal($controller_status, STATUS_ACTIVE)) {
				if ($params) {
					preg_match_all("#({(.*?)}|\((.*?)\))#", $router['pattern'], $route_params);
					if (equal(count($params), count($route_params[0]))) {
						return '/' . trim(str_replace($route_params[0], $params, $router['pattern']), '/');
					}
				}
				return '/' . trim($router['pattern'], '/');
			}
		}
		return null;
	}

	/**
	 * @param array $access_params
	 * @return bool
	 */
	function access($access_params)
	{
		if ($access_params) {
			$access = new Access();
			if (!$access->checkAccessGranted($access_params) || $access->checkAccessDenied($access_params)) {
				return false;
			}
		}
		return true;
	}

	function make_link_query($link, array $query, $merge = true)
	{
		$query_string = $link;
		if ($merge) {
			$request = Request::getInstance();
			$query = array_merge($request->getRequestQuery(), $query);
		}
		$query_string .= '?' . urldecode(http_build_query($query));
		return $query_string;
	}

	function external($link)
	{
		return Config::core('site_scheme') . '://' . Config::core('site_host') . '/' . trim($link, '/');
	}

	function htmlspecialchars_r($string, $flags = ENT_COMPAT, $encoding = 'UTF-8', $double_encode = true)
	{
		if (is_array($string)) {
			$result = array();
			foreach ($string as $key => $value) {
				if (is_array($value)) {
					$result[$key] = htmlspecialchars_r($value, $flags, $encoding, $double_encode);
				} else {
					$result[$key] = htmlspecialchars($value, $flags, $encoding, $double_encode);
				}
			}
			return $result;
		}
		return htmlspecialchars($string, $flags, $encoding, $double_encode);
	}

	function csrf()
	{
		return encode(Session::getCSRFToken('csrf'));
	}

	function csrf_equal($value)
	{
		return equal(encode(Session::getCSRFToken('csrf')), $value);
	}

	function isLogged()
	{
		return Session::auth('id');
	}

	function me($id)
	{
		return equal(Session::auth('id'), $id);
	}