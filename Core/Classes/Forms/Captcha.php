<?php

	namespace Core\Classes\Forms;

	use Core\Classes\Session\Session;

	/**
	 * @example-set
	 * $form = new \Core\Classes\Forms\Form();
	 * $form->text('name');
	 * $form->email('mail');
	 * $form->captcha();                // \Core\Classes\Forms\Form::captcha()
	 * $form->renderForm();
	 *
	 * @example-check
	 * $form = new \Core\Classes\Forms\Form();
	 * $form->text('name');
	 * $form->email('mail');
	 * $validator = $form->validate();
	 * $validator->captcha();            // \Core\Classes\Forms\Validator::captcha()
	 * if($form->can()){
	 *    return \Core\Classes\Response\Response::getInstance()->redirect();
	 * }
	 * $form->captcha();                // \Core\Classes\Forms\Form::captcha()
	 * $form->renderForm();
	 *
	 * Class Captcha
	 * @package Core\Classes\Forms
	 */
	class Captcha
	{
		protected $word;
		protected $fontSize = 24;
		protected $type = 'png';

		public function __construct()
		{
		}

		public function getWord()
		{
			return $this->word;
		}

		public function getFontSize()
		{
			return $this->fontSize;
		}

		public function getType()
		{
			return $this->type;
		}

		public function word($word)
		{
			$this->word = $word;
			return $this;
		}

		public function fontSize($size)
		{
			$this->fontSize = $size;
			return $this;
		}

		public function type($type)
		{
			$this->type = $type;
			return $this;
		}

		public function call(callable $callback)
		{
			call_user_func($callback, $this);
			return $this;
		}

		public function getImage()
		{
			$letters = preg_split('//u', $this->word, null, PREG_SPLIT_NO_EMPTY);
			$textLength = count($letters);
			$captcha_width = ($textLength * $this->fontSize);
			$captcha_height = $this->fontSize + 16;
			$fontXpos = $captcha_width / 12;
			$fontYpos = $captcha_height - 10;
			$function = "image{$this->type}";
			if (!function_exists($function)) {
				$function = "imagepng";
				$this->type = "png";
			}
			$img = imagecreatetruecolor($captcha_width, $captcha_height);
			$bgcolor = imagecolorallocate($img, 225, 225, 225);
			$pixelcolor = imagecolorallocate($img, rand(1, 255), rand(1, 255), rand(1, 255));
			$linecolor = imagecolorallocate($img, rand(1, 255), rand(1, 255), rand(1, 255));
			imagefilledrectangle($img, 0, 0, $captcha_width, $captcha_height, $bgcolor);
			$font = get_root_theme('fonts/captcha/arialn.ttf');
			for ($i = 0; $i < rand(5, 15); $i++) {
				imageline($img, 0, rand() % $captcha_height, $captcha_width, rand() % $captcha_height, $linecolor);
			}
			for ($i = 1; $i < ($captcha_width * $captcha_height) / 5; $i++) {
				imagesetpixel($img, rand() % $captcha_width, rand() % $captcha_height, $pixelcolor);
			}
			foreach ($letters as $k => $letter) {
				$textcolor = imagecolorallocate($img, rand(0, 122), rand(0, 122), rand(0, 122));
				imagettftext($img, $this->fontSize - rand(-3, 3), 0, $fontXpos + ($k * ($this->fontSize / 1.2)), $fontYpos - rand(-5, 5), $textcolor, $font, $letter);
			}
			ob_start();
			$function($img);
			$result = ob_get_contents();
			ob_end_clean();
			return "data:image/{$this->type};base64," . base64_encode($result);
		}

		public function setCaptchaImage()
		{
			$word = gen(rand(5, 8));
			Session::system('captcha', strtolower($word));
			return $this->word($word)
				->type('png')
				->fontSize(rand(12, 36))
				->getImage();
		}
	}