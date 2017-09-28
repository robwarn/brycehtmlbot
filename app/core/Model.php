<?
namespace app\core;
class Model {
	protected function instance() {
		return new Database;
	}

	public function truncate($text) {
		$maxPos = 100;
		if (strlen($text) > $maxPos) {
	    $lastPos = ($maxPos - 3) - strlen($text);
	    return $text = substr($text, 0, strrpos($text, ' ', $lastPos)) . '...';
		}
	}	
}
