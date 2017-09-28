<?
namespace app\core;
use PDO;
class Database {
  private $dbh, $table, $data;
  public function __construct() {
    try {
      $this->dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);

    } catch (PDOException $err) {
      echo '<pre>', print_r($err->getMessage(), true), '</pre>';
      die();
    }
  }

  public function set($table, $data) {
    $this->table = strtolower(preg_replace("/(?<=[a-zA-Z])(?=[A-Z])/", "_", $table));
    $this->data = $data;

    if ($this->isTable($this->table)) {
      $insert = [];
      $values = [];
      $execute = [];

      foreach ($this->data as $key => $data) {
        array_push($insert, $key);
        array_push($values, ':' . $key);
        $execute[':' . $key] = $data;
      }

      $insert = implode(', ', $insert);
      $values = implode(', ', $values);

      $sql = "INSERT INTO {$this->table} ({$insert}) VALUES ({$values})";
      $query = $this->dbh->prepare($sql);
      $query->execute($execute);

    } else {
      echo $this->table;
    }
  }

  private function isTable($table) {
    try {
      $results = $this->dbh->query("SELECT 1 FROM {$table} LIMIT 1");
    } catch (Exception $e) {
      return false;
    }
    return $results !== false;
  }
}
