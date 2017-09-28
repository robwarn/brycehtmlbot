<?
namespace app\config;
class DB_Config {
  protected static $db;
  static public function init() {
    self::getDatabaseCredentials();
    define('DB_HOST', self::$db['host']);
    define('DB_NAME', self::$db['name']);
    define('DB_USERNAME', self::$db['username']);
    define('DB_PASSWORD', self::$db['password']);
  }
  static private function getDatabaseCredentials() {
    self::$db = [
      'host' => '',
      'name' => '',
      'username' => '',
      'password' => ''
    ];

    if (strstr(HOST, 'localhost')) {
      self::$db = [
        'host' => '',
        'name' => '',
        'username' => '',
        'password' => ''
      ];
    }
  }
}
