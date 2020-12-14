<?php
  $filePath = realpath(dirname(__FILE__));

  include_once $filePath.'/../lib/database.php';
  include_once $filePath.'/../helpers/format.php';
?>

<?php
  class Category {
    private $db;
    private $fm;

    public function __construct() {
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function insertCategory($catName) {
      $catName = $this->fm->validation($catName);
      $catName = mysqli_escape_string($this->db->link, $catName);

      if (empty($catName)) {
        $alert = "<span class='error'>Category Name must be not empty</span>";
  
        return $alert;
      } else {
        $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
        $result = $this->db->insert($query);

        if ($result) {
          $alert = "<span class='success'>Insert category successfully</span>";

          return $alert;
        } else {
          $alert = "<span class='error'>Insert category not success</span>";

          return $alert;
        }
      }
    }

    public function showCategory() {
      $query = 'SELECT * FROM tbl_category ORDER BY catId';

      $result = $this->db->select($query);

      return $result;
    }

    public function getCatById($id) {
      $query = "SELECT * FROM tbl_category WHERE catId = '$id'";

      $result = $this->db->select($query);

      return $result;
    }

    public function updateCategory($id, $catName) {
      $catName = $this->fm->validation($catName);
      $catName = mysqli_escape_string($this->db->link, $catName);
      $id = mysqli_escape_string($this->db->link, $id);

      if (empty($catName)) {
        $alert = "<span class='error'>Category must be not empty</span>";

        return $alert;
      } else {
        $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";

        $result = $this->db->update($query);

        if ($result) {
          $alert = "<span class='success'>Update category successfully</span>";
  
          return $alert;
        } else {
          $alert = "<span class='error'>Update category not success</span>";
  
          return $alert;
        }
      }
    }

    public function deleteCategory($id) {
      $query = "DELETE FROM tbl_category WHERE catId = '$id'";

      $result = $this->db->delete($query);

      if ($result) {
        $alert = "<span class='success'>Deleted category successfully</span>";

        return $alert;
      } else {
        $alert = "<span class='error'>Deleted category not success</span>";

        return $alert;
      }
    }
  }
?>