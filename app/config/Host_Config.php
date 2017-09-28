<?
namespace app\config;
class Host_Config {
  static public function init() {
    // Folder Directory
    define('FOLDER_DIR', '');

    // Host Directory
    if (strstr($_SERVER['HTTP_HOST'], 'localhost')) {
			define('HOST', 'http://'.$_SERVER['HTTP_HOST'].'/'.FOLDER_DIR);
		} else {
			define('HOST', 'http://'.$_SERVER['HTTP_HOST']);
		}

    define('PAGE', 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

    // Public Directory
    define('PUB', HOST.'/public');
		define('IMAGES', PUB.'/images');
		define('LIBS', PUB.'/libs');
		define('SCRIPTS', PUB.'/scripts');
			define('DIST', SCRIPTS.'/dist');
		define('STYLES', PUB.'/styles');
			define('COMPILED', STYLES.'/compiled');
		define('VIDEOS', PUB.'/videos');
  }
}
