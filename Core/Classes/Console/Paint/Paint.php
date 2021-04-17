<?php

	namespace Core\Classes\Console\Paint;

	use Core\Interfaces\Console\Paint\Colors;
	use Core\Interfaces\Console\Paint\Fons;
	use Core\Interfaces\Console\Paint\Result;

	/**
	 * Class Paint
	 * @package Core\Classes\Console
	 * @method self colorBlack()
	 * @method self colorBlue()
	 * @method self colorGreen()
	 * @method self colorCyan()
	 * @method self colorRed ()
	 * @method self colorPurple()
	 * @method self colorBrown()
	 * @method self colorYellow()
	 * @method self colorWhite()
	 * @method self colorLightGray()
	 * @method self colorLightPurple()
	 * @method self colorLightRed()
	 * @method self colorLightCyan()
	 * @method self colorLightGreen()
	 * @method self colorLightBlue()
	 * @method self colorDarkGray()
	 * @method self fonBlack()
	 * @method self fonRed()
	 * @method self fonGreen()
	 * @method self fonYellow()
	 * @method self fonBlue()
	 * @method self fonMagenta()
	 * @method self fonCyan()
	 * @method self fonLightGray()
	 *
	 * @example Paint::string('some)->fonGreen()->print(null, ' - ');
	 * @example Paint::string('variable')->fonMagenta()->print();
	 */
	class Paint
	{
		private static $messages = array();

		private $message = array(
			'fon' => null,
			'color' => null,
			'string' => null,
			'before' => null,
			'after' => null,
		);

		protected $colors = array(
			'colorBlack' => '0;30',
			'colorBlue' => '0;34',
			'colorGreen' => '0;32',
			'colorCyan' => '0;36',
			'colorRed' => '0;31',
			'colorPurple' => '0;35',
			'colorBrown' => '0;33',
			'colorYellow' => '1;33',
			'colorWhite' => '1;37',
			'colorLightGray' => '0;37',
			'colorLightPurple' => '1;35',
			'colorLightRed' => '1;31',
			'colorLightCyan' => '1;36',
			'colorLightGreen' => '1;32',
			'colorLightBlue' => '1;34',
			'colorDarkGray' => '1;30',
			'fonBlack' => '40',
			'fonRed' => '41',
			'fonGreen' => '42',
			'fonYellow' => '43',
			'fonBlue' => '44',
			'fonMagenta' => '45',
			'fonCyan' => '46',
			'fonLightGray' => '47',
		);

		private $string;
		private $color;
		private $fon;
		private $result = '';

		public function __call($name, $arguments)
		{
			if (isset($this->colors[$name])) {
				if (equal(substr($name, 0, 3), 'fon')) {
					return $this->setFon($this->colors[$name]);
				}
				return $this->setColor($this->colors[$name]);
			}
			return $this;
		}

		public function __construct($string)
		{
			$this->string = $string;
			$this->message['string'] = $this->string;
		}

		/**
		 * @param $string
		 * @return Fons|Colors|Result|self
		 */
		public static function string($string)
		{
			return new self($string);
		}

		public function setColor($color)
		{
			$this->message['color'] = array_search($color, $this->colors);
			$this->color = "\033[" . $color . "m";
			return $this;
		}

		public function setFon($fon)
		{
			$this->message['fon'] = array_search($fon, $this->colors);
			$this->fon = "\033[" . $fon . "m";
			return $this;
		}

		public function get($before = null, $after = PHP_EOL)
		{
			$this->message['before'] = $before;
			$this->message['after'] = $after;

			$this->result .= $before;
			$this->result .= $this->color;
			$this->result .= $this->fon;
			$this->result .= $this->string;
			$this->result .= "\033[0m";
			$this->result .= $after;
			return $this->result;
		}

		public function print($before = null, $after = PHP_EOL)
		{
			$message = $this->get($before, $after);
			$this->setMessage();
			return __(is_cli() ? $message : null);
		}

		protected function setMessage()
		{
			self::$messages[] = $this->message;
			return $this;
		}

		public static function getMessages()
		{
			return self::$messages;
		}
	}