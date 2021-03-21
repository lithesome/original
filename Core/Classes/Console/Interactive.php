<?php

	namespace Core\Classes\Console;

	/**
	 * Class Interactive
	 * @package Core\Classes\Console
	 *
	 * @TEST get input data
	 * $interactive = Interactive::dialog('enter some');
	 * pre($interactive->getConsoleInput());
	 *
	 * @TEST check input data (recursive)
	 * $interactive = Interactive::dialog('enter some');
	 * $interactive->check('fuck! ENTER `some`!',function(Interactive $interactive){
	 *    if(equal($interactive->getConsoleInput(), 'some')){
	 *        $interactive->granted(true);
	 *    }
	 * });
	 * pre($interactive->getConsoleInput());
	 *
	 * @TEST check input data with paint string (recursive)
	 * $interactive = Interactive::dialog(Paint::string('enter some')->fonGreen()->get(null, null));
	 * $interactive->check(Paint::string('fuck! ENTER `some`!')->fonRed()->get(null, null), function(Interactive $interactive){
	 *  if(equal($interactive->getConsoleInput(),'some')){
	 *   $interactive->granted(true);
	 *  }
	 * });
	 * pre($interactive->getConsoleInput());
	 */
	class Interactive
	{
		private $result;
		private $granted;
		private $string;

		public static function dialog($string)
		{
			$self = new self($string);
			$self->setResult();
			return $self;
		}

		public function __construct($string)
		{
			$this->setDialog($string);
		}

		public function check($error_message, callable $function)
		{
			call_user_func($function, $this);
			if (!$this->granted) {
				$this->setDialog($error_message);
				$this->setResult();
				$this->check($error_message, $function);
			}
			return $this;
		}

		public function getConsoleInput()
		{
			return $this->result;
		}

		public function granted(bool $trigger)
		{
			$this->granted = $trigger;
			return $trigger;
		}

		protected function setDialog($string)
		{
			$this->string = $string;
			return $this;
		}

		protected function printString()
		{
			__($this->string . ': > ');
			return $this;
		}

		protected function setResult()
		{
			$this->printString();
			$this->result = trim(fgets(STDIN));
			return $this;
		}
	}