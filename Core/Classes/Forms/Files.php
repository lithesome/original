<?php

	namespace Core\Classes\Forms;

	use Core\Interfaces\Forms\Form;

	class Files
	{
		const MIME_TYPES = array(
			'image/webp' => '.webp',
			'application/postscript' => '.ps',
			'audio/x-aiff' => '.aiff',
			'text/plain' => '.txt',
			'video/x-ms-asf' => '.asx',
			'audio/basic' => '.snd',
			'video/x-msvideo' => '.avi',
			'application/x-bcpio' => '.bcpio',
			'application/octet-stream' => '.so',
			'image/bmp' => '.bmp',
			'application/x-rar' => '.rar',
			'application/x-bzip2' => '.bz2',
			'application/x-netcdf' => '.nc',
			'application/x-kchart' => '.chrt',
			'application/x-cpio' => '.cpio',
			'application/mac-compactpro' => '.cpt',
			'application/x-csh' => '.csh',
			'text/css' => '.css',
			'application/x-director' => '.dxr',
			'image/vnd.djvu' => '.djvu',
			'application/x-dvi' => '.dvi',
			'image/vnd.dwg' => '.dwg',
			'application/epub' => '.epub',
			'application/epub+zip' => '.epub',
			'text/x-setext' => '.etx',
			'application/andrew-inset' => '.ez',
			'video/x-flv' => '.flv',
			'image/gif' => '.gif',
			'application/x-gtar' => '.gtar',
			'application/x-gzip' => '.tgz',
			'application/x-hdf' => '.hdf',
			'application/mac-binhex40' => '.hqx',
			'text/html' => '.html',
			'text/htm' => '.htm',
			'x-conference/x-cooltalk' => '.ice',
			'image/ief' => '.ief',
			'model/iges' => '.igs',
			'text/vnd.sun.j2me.app-descriptor' => '.jad',
			'application/x-java-archive' => '.jar',
			'application/x-java-jnlp-file' => '.jnlp',
			'image/jpeg' => '.jpg',
			'application/x-javascript' => '.js',
			'audio/midi' => '.midi',
			'application/x-killustrator' => '.kil',
			'application/x-kpresenter' => '.kpt',
			'application/x-kspread' => '.ksp',
			'application/x-kword' => '.kwt',
			'application/vnd.google-earth.kml+xml' => '.kml',
			'application/vnd.google-earth.kmz' => '.kmz',
			'application/x-latex' => '.latex',
			'audio/x-mpegurl' => '.m3u',
			'application/x-troff-man' => '.man',
			'application/x-troff-me' => '.me',
			'model/mesh' => '.silo',
			'application/vnd.mif' => '.mif',
			'video/quicktime' => '.mov',
			'video/x-sgi-movie' => '.movie',
			'audio/mpeg' => '.mp3',
			'video/mp4' => '.mp4',
			'video/mpeg' => '.mpeg',
			'application/x-troff-ms' => '.ms',
			'video/vnd.mpegurl' => '.mxu',
			'application/vnd.oasis.opendocument.database' => '.odb',
			'application/vnd.oasis.opendocument.chart' => '.odc',
			'application/vnd.oasis.opendocument.formula' => '.odf',
			'application/vnd.oasis.opendocument.graphics' => '.odg',
			'application/vnd.oasis.opendocument.image' => '.odi',
			'application/vnd.oasis.opendocument.text-master' => '.odm',
			'application/vnd.oasis.opendocument.presentation' => '.odp',
			'application/vnd.oasis.opendocument.spreadsheet' => '.ods',
			'application/vnd.oasis.opendocument.text' => '.odt',
			'application/ogg' => '.ogg',
			'video/ogg' => '.ogv',
			'application/vnd.oasis.opendocument.graphics-template' => '.otg',
			'application/vnd.oasis.opendocument.text-web' => '.oth',
			'application/vnd.oasis.opendocument.presentation-template' => '.otp',
			'application/vnd.oasis.opendocument.spreadsheet-template' => '.ots',
			'application/vnd.oasis.opendocument.text-template' => '.ott',
			'image/x-portable-bitmap' => '.pbm',
			'chemical/x-pdb' => '.pdb',
			'application/pdf' => '.pdf',
			'image/x-portable-graymap' => '.pgm',
			'application/x-chess-pgn' => '.pgn',
			'text/x-php' => '.php',
			'image/png' => '.png',
			'image/x-portable-anymap' => '.pnm',
			'image/x-portable-pixmap' => '.ppm',
			'application/vnd.ms-powerpoint' => '.ppt',
			'audio/x-realaudio' => '.ra',
			'audio/x-pn-realaudio' => '.rm',
			'image/x-cmu-raster' => '.ras',
			'image/x-rgb' => '.rgb',
			'application/x-troff' => '.tr',
			'application/x-rpm' => '.rpm',
			'text/rtf' => '.rtf',
			'text/richtext' => '.rtx',
			'text/sgml' => '.sgml',
			'application/x-sh' => '.sh',
			'application/x-shar' => '.shar',
			'application/vnd.symbian.install' => '.sis',
			'application/x-stuffit' => '.sit',
			'application/x-koan' => '.skt',
			'application/smil' => '.smil',
			'image/svg+xml' => '.svg',
			'application/x-futuresplash' => '.spl',
			'application/x-wais-source' => '.src',
			'application/vnd.sun.xml.calc.template' => '.stc',
			'application/vnd.sun.xml.draw.template' => '.std',
			'application/vnd.sun.xml.impress.template' => '.sti',
			'application/vnd.sun.xml.writer.template' => '.stw',
			'application/x-sv4cpio' => '.sv4cpio',
			'application/x-sv4crc' => '.sv4crc',
			'application/x-shockwave-flash' => '.swf',
			'application/vnd.sun.xml.calc' => '.sxc',
			'application/vnd.sun.xml.draw' => '.sxd',
			'application/vnd.sun.xml.writer.global' => '.sxg',
			'application/vnd.sun.xml.impress' => '.sxi',
			'application/vnd.sun.xml.math' => '.sxm',
			'application/vnd.sun.xml.writer' => '.sxw',
			'application/x-tar' => '.tar',
			'application/x-tcl' => '.tcl',
			'application/x-tex' => '.tex',
			'application/x-texinfo' => '.texinfo',
			'image/tiff' => '.tiff',
			'image/tiff-fx' => '.tiff',
			'application/x-bittorrent' => '.torrent',
			'text/tab-separated-values' => '.tsv',
			'application/x-ustar' => '.ustar',
			'application/x-cdlink' => '.vcd',
			'model/vrml' => '.wrl',
			'audio/x-wav' => '.wav',
			'audio/x-ms-wax' => '.wax',
			'image/vnd.wap.wbmp' => '.wbmp',
			'application/vnd.wap.wbxml' => '.wbxml',
			'video/x-ms-wm' => '.wm',
			'audio/x-ms-wma' => '.wma',
			'text/vnd.wap.wml' => '.wml',
			'application/vnd.wap.wmlc' => '.wmlc',
			'text/vnd.wap.wmlscript' => '.wmls',
			'application/vnd.wap.wmlscriptc' => '.wmlsc',
			'video/x-ms-wmv' => '.wmv',
			'video/x-ms-wmx' => '.wmx',
			'video/x-ms-wvx' => '.wvx',
			'image/x-xbitmap' => '.xbm',
			'application/xhtml+xml' => '.xhtml',
			'application/xml' => '.xml',
			'image/x-xpixmap' => '.xpm',
			'text/xsl' => '.xsl',
			'image/x-xwindowdump' => '.xwd',
			'chemical/x-xyz' => '.xyz',
			'application/zip' => '.zip',
			'application/msword' => '.doc',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => '.dotx',
			'application/vnd.ms-word.document.macroEnabled.12' => '.docm',
			'application/vnd.ms-excel' => '.xls',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => '.xlsx',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.template' => '.xltx',
			'application/vnd.ms-excel.sheet.macroEnabled.12' => '.xlsm',
			'application/vnd.ms-excel.template.macroEnabled.12' => '.xltm',
			'application/vnd.ms-excel.addin.macroEnabled.12' => '.xlam',
			'application/vnd.ms-excel.sheet.binary.macroEnabled.12' => '.xlsb',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation' => '.pptx',
			'application/vnd.openxmlformats-officedocument.presentationml.template' => '.potx',
			'application/vnd.openxmlformats-officedocument.presentationml.slideshow' => '.ppsx',
			'application/vnd.ms-powerpoint.addin.macroEnabled.12' => '.ppam',
			'application/vnd.ms-powerpoint.presentation.macroEnabled.12' => '.pptm',
			'application/vnd.ms-powerpoint.template.macroEnabled.12' => '.potm',
			'application/vnd.ms-powerpoint.slideshow.macroEnabled.12' => '.ppsm',
		);

		protected $error;

		/** @var Form */
		protected $form;
		protected $raw_files = array(
			'name' => '',
			'type' => '',
			'size' => 0,
			'error' => '',
			'tmp_name' => '',
		);

		protected $prepared_files = array();

		protected $field_name;

		protected $accept = array();

		protected $accept_mime_types = array();

		public function __construct(Form $form, $field_name)
		{
			$this->form = $form;
			$this->field_name = $field_name;

			$this->accept = explode(',', $this->form->getFieldAttribute($this->field_name, 'accept'));
			$this->raw_files = isset($_FILES[$this->field_name]) ? $_FILES[$this->field_name] : $this->raw_files;
			$this->checkErrors()
				->setAllowedMimeTypes();
		}

		protected function setAllowedMimeTypes()
		{
			foreach (self::MIME_TYPES as $key => $value) {
				if (in_array($value, $this->accept)) {
					$this->accept_mime_types[] = $key;
				}
			}
			return $this;
		}

		public function validateMultiple()
		{
			if ($this->error) {
				return $this;
			}
			if (!is_array($this->raw_files['name'])) {
				$this->form->setFieldError($this->field_name, lang('Home.field.field_multiple', array(
					'%field%' => $this->field_name
				)));
				return $this;
			}
			foreach ($this->raw_files['name'] as $index => $file) {
				$this->max_size($file, $this->raw_files['size'][$index]);
				$this->min_size($file, $this->raw_files['size'][$index]);
				$this->accept($file, $this->raw_files['type'][$index]);

				$this->prepareErrors($file, $this->raw_files['error'][$index]);

				$this->prepared_files[$index] = array(
					'name' => $file,
					'size' => $this->raw_files['size'][$index],
					'type' => $this->raw_files['type'][$index],
					'error' => $this->raw_files['error'][$index],
					'tmp_name' => $this->raw_files['tmp_name'][$index],
				);
			}
			return $this;
		}

		public function validateSingle()
		{
			if ($this->error) {
				return $this;
			}
			if (is_array($this->raw_files['name'])) {
				$this->form->setFieldError($this->field_name, lang('Home.field.field_single', array(
					'%field%' => $this->field_name
				)));
				return $this;
			}
			$this->max_size($this->raw_files['name'], $this->raw_files['size']);
			$this->min_size($this->raw_files['name'], $this->raw_files['size']);
			$this->accept($this->raw_files['name'], $this->raw_files['type']);
			$this->prepareErrors($this->raw_files['name'], $this->raw_files['error']);

			$this->prepared_files = $this->raw_files;
			return $this;
		}

		public function getFiles()
		{
			return $this->prepared_files;
		}

		protected function checkErrors()
		{
			$this->error = $this->form->getFieldErrors($this->field_name);
			return $this;
		}

		protected function accept($name, $value)
		{
			if ($value && $this->form->getFieldAttribute($this->field_name, 'accept') && !in_array($value, $this->accept_mime_types)) {
				$this->setFileError(lang('Home.error.accept_not_allowed', array(
					'%accept%' => $value,
					'%accepts%' => $this->form->getFieldAttribute($this->field_name, 'accept'),
					'%file%' => $name
				)));
			}
			return $this;
		}

		protected function min_size($name, $value)
		{
			$min_size = $this->form->getFieldOption($this->field_name, 'min_size');
			if ($value && $min_size && $value < $min_size) {
				$this->setFileError(lang('Home.error.min_size', array(
					'%min_size%' => $min_size,
					'%file%' => $name
				)));
			}
			return $this;
		}

		protected function max_size($name, $value)
		{
			$max_size = $this->form->getFieldOption($this->field_name, 'max_size');
			if ($value && $max_size && $value > $max_size) {
				$this->setFileError(lang('Home.error.max_size', array(
					'%max_size%' => $max_size,
					'%file%' => $name
				)));
			}
			return $this;
		}

		protected function prepareErrors($file_name, $error_code)
		{
			if ($error_code && !$this->errorIs4($error_code)) {
				return $this->setFileError(lang("Home.error.file_upload_error_{$error_code}", array(
					'%file%' => $file_name
				)));
			}
			return $this;
		}

		protected function errorIs4($error_code)
		{
			if (!$this->form->getFieldOption($this->field_name, 'required') && equal($error_code, 4)) {
				return true;
			}
			return false;
		}

		protected function setFileError($error)
		{
			$this->form->setFieldError($this->field_name, $error);
			return $this;
		}

	}