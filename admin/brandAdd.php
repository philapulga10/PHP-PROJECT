<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php' ?>
<?php
  $brand = new Brand();

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];

    $insertBrand = $brand->insertBrand($brandName);
  }
?>
<div class="grid_10">
	<div class="box round first grid">
    <h2>Add New Category</h2>
    <?php
      if (isset($insertBrand)) {
        echo $insertBrand;
      }
    ?>
		<div class="block copyblock">
			<form action="brandAdd.php" method="post">
				<table class="form">
					<tr>
						<td>
							<input type="text" class="medium" name="brandName" placeholder="Enter Brand Name..." />
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="submit" Value="Save" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>