<?
namespace app\config;
class Root_Config {
  static public function init() {
    // Root Directory
    define('ROOT', dirname(dirname(__DIR__)));

    // App Directory
    define('APP', ROOT.'/app');
      define('CONFIG', APP.'/config');
      define('CONTROLLERS', APP.'/controllers');
      define('CORE', APP.'/core');
      define('HELPERS', APP.'/helpers');
      define('TEMPLATES', APP.'/templates');
        define('TEMPLATES_EMAILS', TEMPLATES.'/emails');
        define('TEMPLATES_LAYOUTS', TEMPLATES.'/layouts');
        define('TEMPLATES_GLOBALS', TEMPLATES.'/globals');
      define('MODELS', APP.'/models');
      define('MODULES', APP.'/modules');
        define('MODULES_MODELS', MODULES.'/models');
        define('MODULES_VIEWS', MODULES.'/views');
      define('VIEWS', APP.'/views');
  }
}
