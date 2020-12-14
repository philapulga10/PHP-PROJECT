<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/product.php'; ?>
<?php
  $product = new Product();

	if (!isset($_GET['productId']) && $_GET['productId'] !== null) {
    echo "<script>window.location='productList.php'</script>";
  } else {
    $id = $_GET['productId'];
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $updateProduct = $product->updateProduct($_POST, $_FILES, $id);
  }
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Edit Product</h2>
		<div class="block">
			<!-- chú ý vì có thêm hình ảnh nên phải có enctype="multipart/form-data" nhé, không có sẽ không -->
			<!-- thêm hình ảnh được -->
			<?php
				if (isset($updateProduct)) {
					echo $updateProduct;
				}
			?>
      <?php
        $productById = $product->getProductById($id);

        if ($productById) {
          while ($resultProduct = $productById->fetch_assoc()) {
      ?>
            <form action="" method="post" enctype="multipart/form-data">
              <table class="form">
                <tr>
                  <td>
                    <label>Name</label>
                  </td>
                  <td>
                    <input type="text" name="productName" value="<?php echo $resultProduct['productName'] ?>" placeholder="Enter Product Name..." class="medium" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Category</label>
                  </td>
                  <td>
                      <select id="select" name="category">
                        <option>------------ Select Category ------------</option>
                        <?php
                          $cat = new Category();

                          $catList = $cat->showCategory();

                          if ($catList) {
                            while ($result = $catList->fetch_assoc()) {
                        ?>
                          <option
                            <?php
                              if ($result['catId'] === $resultProduct['catId']) {
                                echo 'selected';
                              }
                            ?>
                            value="<?php echo $result['catId']; ?>"
                          >
                            <?php echo $result['catName']; ?>
                          </option>
                        <?php
                            }
                          }
                        ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Brand</label>
                  </td>
                  <td>
                    <select id="select" name="brand">
                      <option>------------ Select Brand ------------</option>
                      <?php
                        $brand = new Brand();

                        $brandList = $brand->showBrand();

                        if ($brandList) {
                        while ($result = $brandList->fetch_assoc()) {
                      ?>
                        <option
                          <?php
                            if ($result['brandId'] === $resultProduct['brandId']) {
                              echo 'selected';
                            }
                          ?>
                            value="<?php echo $result['brandId']; ?>"
                          >
                            <?php echo $result['brandName']; ?>
                        </option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top; padding-top: 9px;">
                    <label>Description</label>
                  </td>
                  <td>
                    <textarea name="productDescription" class="tinymce">
                      <?php echo $resultProduct['productDescription']; ?>
                    </textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Price</label>
                  </td>
                  <td>
                    <input type="text" name="price" value="<?php echo $resultProduct['price']; ?>" class="medium" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Upload Image</label>
                  </td>
                  <td>
                    <img src="uploads/<?php echo $resultProduct['image'] ?>" width="90">
                    <br />
                    <input type="file" name="image" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Product Type</label>
                  </td>
                  <td>
                    <select id="select" name="type">
                      <option>Select Type</option>
                      <?php
                        if ($resultProduct['type'] === 0) {
                      ?>
                        <option selected value="0">Non-Featured</option>
                        <option value="1">Featured</option>
                      <?php
                        } else {
                      ?>
                          <option value="0">Non-Featured</option>
                          <option selected value="1">Featured</option>
                      <?php
                        }
                      ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <input type="submit" name="submit" Value="Save" />
                  </td>
                </tr>
              </table>
            </form>
      <?php
          }
        }
      ?>
		</div>
	</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		setupTinyMCE();
		setDatePicker('date-picker');
		$('input[type="checkbox"]').fancybutton();
		$('input[type="radio"]').fancybutton();
	});
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>