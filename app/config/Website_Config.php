<?
namespace app\config;
class Website_Config {
  public static $WEBSITE_KEYS = [
    'website.compiled' => COMPILED,
    'website.dir' => ROOT,
    'website.dist' => DIST,
    'website.favicon' => IMAGES.'/favicon.png',
    'website.images' => IMAGES,
    'website.public' => PUB,
    'website.url' => HOST,
  ];

  public static function init() {
		define('EMAIL', '');
		define('NAME', '');
		define('RECEIVER', '');
  }
}
