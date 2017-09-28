<?
namespace app\helpers;
class HeadScript {
	static public $head = '';
	static public $footer = '';

	public function appendStyleSheet($stylesheet) {
		$link = "\r\n" . '<link rel="stylesheet" type="text/css" href="' . $stylesheet . '">' . "\r\n";
		self::$head .= $link;
	}

	public function appendScript($script) {
		$src = "\r\n" . '<script type="text/javascript" src="' . $script . '"></script>' . "\r\n";
		self::$head .= $src;
	}

	public function prependScript($script) {
		$src = "\r\n" . '<script type="text/javascript" src="' . $script . '"></script>' . "\r\n";
		self::$footer .= $src;
	}

	public function appendCustomStyles($stylesheet) {
		$style = "\r\n" . '<style>' . $stylesheet . '</style>' . "\r\n";
		self::$head .= $style;
	}

	public function appendCustomScript($script) {
		$src = "\r\n" . '<script type="text/javascript">' . $script . '</script>' . "\r\n";
		self::$head .= $src;
	}

	public function prependCustomScript($script) {
		$src = "\r\n" . '<script type="text/javascript">' . $script . '</script>' . "\r\n";
		self::$footer .= $src;
	}

}
