<?
namespace app\helpers;
use app\config\Website_Config as Website_Config;
class TemplateEngine {
	private $template;
	private $keys;

	public function __construct() {
		$this->keys = $this->getWebsiteKeys();
	}

	public function init($template) {
		$this->template = $template;
		$braces = [];
		preg_match_all('/{{(.*?)\}}/s', $template, $braces);
		foreach ($braces[1] as $brace) {
			$this->template = isset($this->keys[$brace])
				? $this->replaceBracers($brace, $this->keys[$brace], $this->template)
				: $this->template;
		}
		return $this->template;
	}

	public function appendKeys($keys, $results) {
		if (is_array($keys)) {
			for ($i = 0; $i < count($keys); $i++) {
				$this->keys[$keys[$i]] = $results[$i];
			}
		} else {
			$this->keys[$keys] = $results;
		}
	}

	private function getWebsiteKeys() {
		return Website_Config::$WEBSITE_KEYS;
	}

	private function replaceBracers($search, $replace, $subject) {
		return str_replace(['{{', $search, '}}'], ['', $replace, ''], $subject);
	}
}
