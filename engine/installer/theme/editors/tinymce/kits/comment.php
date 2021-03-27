<?php

	use Core\Classes\Render;

	/** @var Render $this */

	/**
	 * @var string $file
	 * @var array $content
	 * @var string $name
	 * @var string $value
	 * @var string $id
	 * @var string $editor
	 * @var string $kit
	 * @var string $placeholder
	 * @var string $type
	 * @var string $data_id
	 * @var string $lang
	 * @var string $unique
	 */
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/tinymce.min.js"></script>
<script>
	if (!defined(window.TinyMceObject) && !defined(window.TinyMceObjectComment)) {
		window.TinyMceObjectComment = true;
		window.TinyMceObject = {
			init: function () {
				tinymce.init({
					selector: 'textarea[data-id=<?php __($editor . '-' . $kit) ?>]',
					language: '<?php __($lang) ?>',
					placeholder: "<?php __(isset($placeholder) ? $placeholder : '') ?>",
					branding: false,
					body_class: 'full',
					content_css: '<?php __(get_http_theme('editors/tinymce/custom/tinymce.css')) ?>',

					statusbar: false,
					elementpath: false,
					wordcount: false,
					resize: false,

					menubar: false,
					inline: false,
					toolbar_sticky: true,
					relative_urls: false,
					remove_script_host: false,

					browser_spellcheck: true,
					height: 100,

					fontsize_formats: '11px 12px 14px 16px 18px 24px 36px 48px',
					font_formats:
					'Aileron=AileronRegular;' +
					'Andale Mono=andale mono,times;' +
					'Arial=arial,helvetica,sans-serif;' +
					'Arial Black=arial black,avant garde;' +
					'Book Antiqua=book antiqua,palatino;' +
					'Comic Sans MS=Comic Sans MS,sans-serif;' +
					'Courier New=courier new,courier;' +
					'Georgia=georgia,palatino;' +
					'Helvetica=helvetica;' +
					'Impact=impact,chicago;' +
					'Symbol=symbol;' +
					'Tahoma=tahoma,arial,helvetica,sans-serif;' +
					'Terminal=terminal,monaco;' +
					'Times New Roman=times new roman,times;' +
					'Trebuchet MS=trebuchet ms,geneva;' +
					'Verdana=verdana,geneva;' +
					'Webdings=webdings;' +
					'Wingdings=wingdings,zapf dingbats',
					block_formats:
					'Header 1=h1;' +
					'Header 2=h2;' +
					'Header 3=h3;' +
					'Header 4=h4;' +
					'Header 5=h5;',
					plugins:
					" autolink" +
					" link emoticons charmap" +
					"",
					toolbar: /*false*/
					"bold italic underline strikethrough|" +
					"forecolor backcolor|" +
					"blockquote charmap emoticons|",
					quickbars_insert_toolbar: false,
					quickbars_selection_toolbar: false,
					image_caption: true,
					imagetools_toolbar: false,
					contextmenu: false,
					contextmenu_never_use_native: false,
					toolbar_drawer: 'sliding',
					codesample_languages: [
						{text: 'PHP', value: 'php'},
						{text: 'HTML', value: 'html'},
						{text: 'JAVA Script', value: 'javascript'},
						{text: 'python', value: 'python'},
						{text: 'BASH', value: 'bash'},
						{text: 'SQL', value: 'sql'},
						{text: 'XML', value: 'xml'},
						{text: 'Apache', value: 'apache'},
						{text: 'JAVA', value: 'java'},
						{text: 'JSON', value: 'json'},
						{text: '1C', value: '1c'},
						{text: 'BASIC', value: 'basic'},
						{text: 'C++', value: 'cpp'},
						{text: 'CSS', value: 'css'},
						{text: 'DELPHI', value: 'delphi'},
						{text: 'INI', value: 'ini'},
						{text: 'PERL', value: 'perl'},
						{text: 'plain/text', value: 'plaintext'},
						{text: 'POWERSHELL', value: 'powershell'},
						{text: 'RUBY', value: 'ruby'},
						{text: 'COFFEE Script', value: 'coffeescript'},

						{text: 'ABNf', value: 'abnf'},
						{text: 'AccessLOG', value: 'accesslog'},
						{text: 'Action Script', value: 'actionscript'},
						{text: 'ADA', value: 'ada'},
						{text: 'Angel Script', value: 'angelscript'},
						{text: 'Apple Script', value: 'applescript'},
						{text: 'ARCADE', value: 'arcade'},
						{text: 'ArdUIno', value: 'arduino'},
						{text: 'ARM ASM', value: 'armasm'},
						{text: 'ASCII DOC', value: 'asciidoc'},
						{text: 'Aspect J', value: 'aspectj'},
						{text: 'AotoHotKey', value: 'autohotkey'},
						{text: 'AutoIT', value: 'autoit'},
						{text: 'AVR ASM', value: 'avrasm'},
						{text: 'AWK', value: 'awk'},
						{text: 'AXA PTA', value: 'axapta'},
						{text: 'BNF', value: 'bnf'},
						{text: 'Brain FUCK', value: 'brainfuck'},
						{text: 'CAL', value: 'cal'},
						{text: 'C-APN PROTO', value: 'capnproto'},
						{text: 'CEYLON', value: 'ceylon'},
						{text: 'CLEAN', value: 'clean'},
						{text: 'CLOJURE REPl', value: 'clojure-repl'},
						{text: 'CLOJURE', value: 'clojure'},
						{text: 'CMAKE', value: 'cmake'},
						{text: 'COQ', value: 'coq'},
						{text: 'COS', value: 'cos'},
						{text: 'CRM SH', value: 'crmsh'},
						{text: 'CRYSTAL', value: 'crystal'},
						{text: 'CS', value: 'cs'},
						{text: 'CSP', value: 'csp'},
						{text: 'D', value: 'd'},
						{text: 'DART', value: 'dart'},
						{text: 'DIFF', value: 'diff'},
						{text: 'DJANGO', value: 'django'},
						{text: 'DNS', value: 'dns'},
						{text: 'DOCKERFILE', value: 'dockerfile'},
						{text: 'DOS', value: 'dos'},
						{text: 'DS CONFIG', value: 'dsconfig'},
						{text: 'DTS', value: 'dts'},
						{text: 'DUST', value: 'dust'},
						{text: 'EBNf', value: 'ebnf'},
						{text: 'ELIXIR', value: 'elixir'},
						{text: 'ELM', value: 'elm'},
						{text: 'ERB', value: 'erb'},
						{text: 'ER-lang REPl', value: 'erlang-repl'},
						{text: 'ER-langG', value: 'erlang'},
						{text: 'EXCEL', value: 'excel'},
						{text: 'FIX', value: 'fix'},
						{text: 'F-LIX', value: 'flix'},
						{text: 'Fortran', value: 'fortran'},
						{text: 'F-SHARP', value: 'fsharp'},
						{text: 'GAMS', value: 'gams'},
						{text: 'GAUSS', value: 'gauss'},
						{text: 'G-CODE', value: 'gcode'},
						{text: 'GHERKIN', value: 'gherkin'},
						{text: 'GL/SL', value: 'glsl'},
						{text: 'GML', value: 'gml'},
						{text: 'GO', value: 'go'},
						{text: 'GO/LO', value: 'golo'},
						{text: 'GraDLE', value: 'gradle'},
						{text: 'GROOVY', value: 'groovy'},
						{text: 'HAML', value: 'haml'},
						{text: 'HANDLEBARS', value: 'handlebars'},
						{text: 'HASKELL', value: 'haskell'},
						{text: 'HAXE', value: 'haxe'},
						{text: 'HSP', value: 'hsp'},
						{text: 'HTML/BARS', value: 'htmlbars'},
						{text: 'HTTP', value: 'http'},
						{text: 'HY', value: 'hy'},
						{text: 'INFORM7', value: 'inform7'},
						{text: 'IRPF90', value: 'irpf90'},
						{text: 'ISBL', value: 'isbl'},
						{text: 'J-BOSS CLI', value: 'jboss-cli'},
						{text: 'JULIA REPl', value: 'julia-repl'},
						{text: 'JULIA', value: 'julia'},
						{text: 'KOTLIN', value: 'kotlin'},
						{text: 'LASSO', value: 'lasso'},
						{text: 'L-DIF', value: 'ldif'},
						{text: 'LEAF', value: 'leaf'},
						{text: 'LESS', value: 'less'},
						{text: 'LISP', value: 'lisp'},
						{text: 'LIVE-CODE Server', value: 'livecodeserver'},
						{text: 'LIVE Script', value: 'livescript'},
						{text: 'LLVM', value: 'llvm'},
						{text: 'LSL', value: 'lsl'},
						{text: 'LUA', value: 'lua'},
						{text: 'MAKEFILE', value: 'makefile'},
						{text: 'MARKDOWN', value: 'markdown'},
						{text: 'Mathematica', value: 'mathematica'},
						{text: 'MATLAB', value: 'matlab'},
						{text: 'MAXIMA', value: 'maxima'},
						{text: 'MEL', value: 'mel'},
						{text: 'MERCURY', value: 'mercury'},
						{text: 'MIPSASM', value: 'mipsasm'},
						{text: 'MIZAR', value: 'mizar'},
						{text: 'MOJOLICIOUS', value: 'mojolicious'},
						{text: 'MONKEY', value: 'monkey'},
						{text: 'MOON Script', value: 'moonscript'},
						{text: 'N1QL', value: 'n1ql'},
						{text: 'NGINX', value: 'nginx'},
						{text: 'NIMROD', value: 'nimrod'},
						{text: 'NIX', value: 'nix'},
						{text: 'N-SIS', value: 'nsis'},
						{text: 'OBJECTIVE-C', value: 'objectivec'},
						{text: 'oCAML', value: 'ocaml'},
						{text: 'OPENS-CAD', value: 'openscad'},
						{text: 'OXYGEN', value: 'oxygene'},
						{text: 'PARSER-3', value: 'parser3'},
						{text: 'PF', value: 'pf'},
						{text: 'pgSQL', value: 'pgsql'},
						{text: 'PONY', value: 'pony'},
						{text: 'PROCESSING', value: 'processing'},
						{text: 'PROFILE', value: 'profile'},
						{text: 'PRO-LOG', value: 'prolog'},
						{text: 'PROPERTIES', value: 'properties'},
						{text: 'PROTO-BUF', value: 'protobuf'},
						{text: 'PUPPET', value: 'puppet'},
						{text: 'PURE-BASIC', value: 'purebasic'},
						{text: 'Q', value: 'q'},
						{text: 'QML', value: 'qml'},
						{text: 'R', value: 'r'},
						{text: 'REASON-ML', value: 'reasonml'},
						{text: 'RIB', value: 'rib'},
						{text: 'ROBO-CONF', value: 'roboconf'},
						{text: 'ROUTEROS', value: 'routeros'},
						{text: 'RSL', value: 'rsl'},
						{text: 'RULESLANGUAGE', value: 'ruleslanguage'},
						{text: 'RUST', value: 'rust'},
						{text: 'SAS', value: 'sas'},
						{text: 'SCALA', value: 'scala'},
						{text: 'SCHEME', value: 'scheme'},
						{text: 'SCI-LAB', value: 'scilab'},
						{text: 'SCSS', value: 'scss'},
						{text: 'SHELL', value: 'shell'},
						{text: 'SMALI', value: 'smali'},
						{text: 'SMALLTALK', value: 'smalltalk'},
						{text: 'SML', value: 'sml'},
						{text: 'SQF', value: 'sqf'},
						{text: 'STAN', value: 'stan'},
						{text: 'STATA', value: 'stata'},
						{text: 'STEP21', value: 'step21'},
						{text: 'STYLUS', value: 'stylus'},
						{text: 'SUBUNIT', value: 'subunit'},
						{text: 'SWIFT', value: 'swift'},
						{text: 'TAGGER Script', value: 'taggerscript'},
						{text: 'TAP', value: 'tap'},
						{text: 'TCL', value: 'tcl'},
						{text: 'TEX', value: 'tex'},
						{text: 'THRIFT', value: 'thrift'},
						{text: 'TP', value: 'tp'},
						{text: 'TWIG', value: 'twig'},
						{text: 'TYPE Script', value: 'typescript'},
						{text: 'VALA', value: 'vala'},
						{text: 'VB-NET', value: 'vbnet'},
						{text: 'VB-SCRIPT HTML', value: 'vbscript-html'},
						{text: 'VB-SCRIPT', value: 'vbscript'},
						{text: 'VERI-LOG', value: 'verilog'},
						{text: 'V-HDL', value: 'vhdl'},
						{text: 'VIM', value: 'vim'},
						{text: 'X86ASM', value: 'x86asm'},
						{text: 'XL', value: 'xl'},
						{text: 'xQuery', value: 'xquery'},
						{text: 'YAML', value: 'yaml'},
						{text: 'ZEPHIR', value: 'zephir'},
					],
					mobile: {
						height: 150,
						plugins:
						" autolink" +
						" link emoticons charmap" +
						"",
						toolbar: /*false*/
						"bold italic underline strikethrough|" +
						"blockquote charmap emoticons|",
						quickbars_insert_toolbar: false,
						quickbars_selection_toolbar: false,
					},
				});
				return false;
			}
		};
		$(document).ready(TinyMceObject.init);
		$(document).on('ajaxComplete', TinyMceObject.init);
	}
</script>