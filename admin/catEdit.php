<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php' ?>
<?php
	$cat = new Category();

	if (!isset($_GET['catId']) || $_GET['catId'] === NULL) {
		echo "<script>window.location = 'catList.php'</script>";
	} else {
		$id = $_GET['catId'];
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$catName = $_POST['catName'];

		$updateCat = $cat->updateCategory($id, $catName);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Edit Category</h2>
		<div class="block copyblock">
			<?php
				if (isset($updateCat)) {
					echo $updateCat;
				}
			?>
			<?php
				$getCatName = $cat->getCatById($id);

				if ($getCatName) {
					while ($result =  $getCatName->fetch_assoc()) {
			?>
				<!-- lưu ý chỗ action="" -->
				<!-- Nếu không để action="" thì sau khi edit xong nó sẽ redirect về trang catEdit.php mà không ở -->
				<!-- lại trang cateEdit.php?catId=3 -->
				<form action="" method="post">
					<table class="form">
						<tr>
							<td>
								<input
									type="text"
									class="medium"
									name="catName"
									value=<?php echo $result['catName']; ?>
									placeholder="Enter Category Name..."
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