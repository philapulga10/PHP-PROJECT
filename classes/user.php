<?php
  $filePath = realpath(dirname(__FILE__));

  include_once $filePath.'/../lib/database.php';
  include_once $filePath.'/../helpers/format.php';
?>

<?php
  class User {
    private $fm;
    private $db;
  
    public function __construct() {
      $this->fm = new Format();
      $this->db = new Database();
    }
  }
?>