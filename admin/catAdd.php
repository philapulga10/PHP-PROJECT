﻿<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php' ?>
<?php
	$cat = new Category();
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$catName = $_POST['catName'];

		$insertCat = $cat->insertCategory($catName);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Add New Category</h2>
		<?php
			if (isset($insertCat)) {
				echo $insertCat;
			}
		?>
		<div class="block copyblock">
			<form action="catAdd.php" method="post">
				<table class="form">
					<tr>
						<td>
							<input type="text" class="medium" name="catName" placeholder="Enter Category Name..." />
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