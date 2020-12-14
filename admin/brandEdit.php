<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
  $brand = new Brand();

  if (!isset($_GET['brandId']) || $_GET['brandId'] === null) {
    echo "<script>window.location = 'brandList.php'</script>";
  } else {
		$id = $_GET['brandId'];
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$brandName = $_POST['brandName'];

		$updateBrand = $brand->updateBrand($id, $brandName);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Edit Category</h2>
		<?php
			if (isset($updateBrand)) {
				echo $updateBrand;
			}
		?>
		<div class="block copyblock">
      <?php
				$getBrandName = $brand->getBrandById($id);

        if ($getBrandName) {
          while ($result = $getBrandName->fetch_assoc()) {
      ?>
				<form action="" method="post">
					<table class="form">
						<tr>
							<td>
								<input
									type="text"
									class="medium"
									name="brandName"
									value=<?php echo $result['brandName']; ?>
									placeholder="Enter Brand Name..."
                />
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" name="submit" Value="Edit" />
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
<?php include 'inc/footer.php'; ?>