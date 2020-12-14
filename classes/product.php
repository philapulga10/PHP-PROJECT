<?php
  $filePath = realpath(dirname(__FILE__));

  include_once $filePath.'/../lib/database.php';
  include_once $filePath.'/../helpers/format.php';
?>
<?php
  class Product {
    private $fm;
    private $db;

    public function __construct() {
      $this->fm = new Format();
      $this->db = new Database();
    }

    public function insertProduct($data, $files) {
      $productName = mysqli_escape_string($this->db->link, $data['productName']);
      $category = mysqli_escape_string($this->db->link, $data['category']);
      $brand = mysqli_escape_string($this->db->link, $data['brand']);
      $productDescription = mysqli_escape_string($this->db->link, $data['productDescription']);
      $price = mysqli_escape_string($this->db->link, $data['price']);
      $type = mysqli_escape_string($this->db->link, $data['type']);

      // kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
      $permitted = array('jpg','jpeg', 'png', 'gif');
      $fileName = $_FILES['image']['name'];
      $fileSize = $_FILES['image']['size'];
      $fileTemp = $_FILES['image']['tmp_name'];

      $div = explode('.', $fileName);
      $fileExt = strtolower(end($div));
      $uniqueImage = substr(md5(time()), 0, 10).'.'.$fileExt;
      $uploadedImage = "uploads/".$uniqueImage;

      if (
        $productName === '' ||
        $brand === '' ||
        $category === '' ||
        $productDescription === '' ||
        $price === '' ||
        $type === '' ||
        $fileName === ''
      ) {
        $alert = "<span class='error'>Fields be not empty</span>";

        return $alert;
      } else {
        // upload hình ảnh vào folder uploads
        move_uploaded_file($fileTemp, $uploadedImage);

        $query = "INSERT INTO tbl_product(productName, brandId, catId, productDescription, price, type, image) VALUES('$productName', '$brand', '$category', '$productDescription', '$price', '$type', '$uniqueImage ')";

        $result = $this->db->insert($query);

        if ($result) {
          $alert = "<span class='success'>Insert product successfully</span>";

          return $alert;
        } else {
          $alert = "<span class='success'>Insert product not success</span>";

          return $alert;
        }
      }
    }

    public function showProduct() {
      // cách 1
      // $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId ORDER BY tbl_product.productId desc";

      // cách 2
      $query = "SELECT p.*, c.catName, b.brandName FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b WHERE p.catId = c.catId AND p.brandId = b.brandId ORDER BY p.productId DESC";

      $result = $this->db->select($query);

      return $result;
    }

    public function updateProduct($post, $files, $id) {
      $productName = mysqli_escape_string($this->db->link, $post['productName']);
      $category = mysqli_escape_string($this->db->link, $post['category']);
      $brand = mysqli_escape_string($this->db->link, $post['brand']);
      $type = mysqli_escape_string($this->db->link, $post['type']);
      $price = mysqli_escape_string($this->db->link, $post['price']);
      $productDesc = mysqli_escape_string($this->db->link, $post['productDescription']);

      $permitted = array('jpg', 'jpeg', 'png', 'gif');
      $fileName = $_FILES['image']['name'];
      $fileSize = $_FILES['image']['size'];
      $fileTemp = $_FILES['image']['tmp_name'];

      $div = explode('.', $fileName);

      $fileExt = strtolower(end($div));
      $uniqueImage = substr(md5(time()), 0, 10).'.'.$fileExt;
      $uploadedImage = 'uploads/'.$uniqueImage;

      if (!empty($fileName)) {
        if ($fileSize < 2048) {
          $alert = "<span class='error'>Image size should be less then 2MB!</span>";

          return $alert;
        } else if (in_array($fileExt, $permitted) === false) {
          $alert = "<span class='error'>You only upload only:"." ".implode(',', $permitted)."</span>";

          return $alert;
        }

        move_uploaded_file($fileTemp, $uploadedImage);

        $query = "UPDATE tbl_product SET productName='$productName', brandId='$brand', catId='$category', type='$type', price='$price', productDescription='$productDesc', image='$uniqueImage' WHERE productId='$id'";
      } else {
        $query = "UPDATE tbl_product SET productName='$productName', brandId='$brand', catId='$category', type='$type', price='$price', productDescription='$productDesc' WHERE productId='$id'";
      }

      $result = $this->db->update($query);

      if ($result) {
        $alert = "<span class='success'>Product updated successfully</span>";

        return $alert;
      } else {
        $alert = "<span class='success'>Product update not success</span>";

        return $alert;
      }
    }

    public function getProductById($id) {
      $query = "SELECT * FROM tbl_product WHERE productId='$id'";

      $result = $this->db->select($query);

      return $result;
    }

    public function deleteProduct($id) {
      $query = "DELETE FROM tbl_product WHERE productId='$id'";

      $result = $this->db->delete($query);

      if ($result) {
        $alert = "<span class='success'>Deleted product successfully</span>";

        return $alert;
      } else {
        $alert = "<span class='error'>Deleted product not success</span>";

        return $alert;
      }
    }

    public function getProductFeathered() {
      $query = "SELECT * FROM tbl_product WHERE type = '1'";

      $result = $this->db->select($query);

      return $result;
    }

    public function getNewProduct() {
      $query = "SELECT * FROM tbl_product ORDER BY productId DESC";

      $result = $this->db->select($query);

      return $result;
    }

    public function getProductDetail($id) {
      $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'";

      $result = $this->db->select($query);

      return $result;
    }
  }
?>