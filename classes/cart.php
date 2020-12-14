<?php
  $filePath = realpath(dirname(__FILE__));

  include_once $filePath.'/../lib/database.php';
  include_once $filePath.'/../helpers/format.php';
?>

<?php
  class Cart {
    private $fm;
    private $db;
  
    public function __construct() {
      $this->fm = new Format();
      $this->db = new Database();
    }

    public function addToCart($id, $quantity) {
      $quantity = $this->fm->validation($quantity);
      $quantity = mysqli_escape_string($this->db->link, $quantity);
      $sessionId = session_id();

      $queryGetProduct = "SELECT * FROM tbl_product WHERE productId='$id'";

      $result = $this->db->select($queryGetProduct)->fetch_assoc();

      $image = $result['image'];
      $price = $result['price'];
      $productName = $result['productName'];

      $queryCheckProduct = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sessionId = '$sessionId'";

      $resultCheckProduct = $this->db->select($queryCheckProduct);

      echo '<prev>';
      echo var_dump($resultCheckProduct);
      echo '</prev>';

      if ($resultCheckProduct) {
        $alert = "Product already added";

        return $alert;
      } else {
        $queryInsertCart = "INSERT INTO tbl_cart(productId, sessionId, productName, price, quantity, image) VALUES('$id', '$sessionId', '$productName', '$price', $quantity, '$image')";

        $resultInsertCart = $this->db->insert($queryInsertCart);

        if ($resultInsertCart) {
          header('Location:cart.php');
        } else {
          header('Location:404.php');
        }
      }
    }

    public function getProductCart() {
      $sessionId = session_id();

      $query = "SELECT * FROM tbl_cart WHERE sessionId='$sessionId'";

      $result = $this->db->select($query);

      return $result;
    }

    public function updateProductQuantity($cartId, $quantity) {
      $cartId = mysqli_escape_string($this->db->link, $cartId);
      $quantity = mysqli_escape_string($this->db->link, $quantity);

      $query = "UPDATE tbl_cart SET quantity='$quantity' WHERE cartId='$cartId'";

      $result = $this->db->update($query);

      if ($result) {
        $alert = "<span class='success'>Product quantity updated successfully</span>";

        return $alert;
      } else {
        $alert = "<span class='error'>Product quantity updated not successfully</span>";

        return $alert;
      }
    }

    public function deleteProductCart($cartIdGetMethod) {
      $cartIdGetMethod = mysqli_escape_string($this->db->link, $cartIdGetMethod);

      $query = "DELETE FROM tbl_cart WHERE cartId = '$cartIdGetMethod'";

      $result = $this->db->delete($query);

      if ($result) {
        header("Location: cart.php");
      } else {
        $alert = "<span class='error'>Product delete not successfully</span>";

        return $alert;
      }
    }
  }
?>