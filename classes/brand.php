<?php
  $filePath = realpath(dirname(__FILE__));

  include_once $filePath.'/../lib/database.php';
  include_once $filePath.'/../helpers/format.php';
?>
<?php
  class Brand {
    private $fm;
    private $db;

    public function __construct() {
      $this->fm = new Format();
      $this->db = new Database();
    }

    public function insertBrand($brandName) {
      $brandName = $this->fm->validation($brandName);
      $brandName = mysqli_escape_string($this->db->link, $brandName);

      if (empty($brandName)) {
        $alert = "<span class='error'>Brand name be not empty</span>";

        return $alert;
      } else {
        $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";

        $result = $this->db->insert($query);

        if ($result) {
          $alert = "<span class='success'>Insert brand successfully</span>";
  
          return $alert;
        } else {
          $alert = "<span class='error'>Insert brand not success</span>";

          return $alert;
        }
      }
    }

    public function showBrand() {
      $query = "SELECT * FROM tbl_brand ORDER BY brandId";

      $result = $this->db->select($query);

      return $result;
    }

    public function getBrandById($id) {
      $query = "SELECT * FROM tbl_brand WHERE brandId='$id'";

      $result = $this->db->select($query);

      return $result;
    }

    public function updateBrand($id, $brandName) {
      $brandName = $this->fm->validation($brandName);
      $brandName = mysqli_escape_string($this->db->link, $brandName);
      $id = mysqli_escape_string($this->db->link, $id);

      if (empty($brandName)) {
        $alert = "<span>Brand name must be not empty</span>";
      } else {
        $query = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$id'";

        $result = $this->db->update($query);

        if ($result) {
          $alert = "<span class='success'>Update brand successfully</span>";
  
          return $alert;
        } else {
          $alert = "<span class='error'>Update brand not success</span>";
  
          return $alert;
        }
      }
    }

    public function deleteBrand($id) {
      $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";

      $result = $this->db->delete($query);

      if ($result) {
        $alert = "<span class='success'>Deleted brand successfully</span>";

        return $alert;
      } else {
        $alert = "<span class='error'>Deleted brand not success</span>";

        return $alert;
      }
    }
  }
?>