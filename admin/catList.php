<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php' ?>
<?php
	$cat = new Category();

	if (isset($_GET['deleteId'])) {
		$id = $_GET['deleteId'];

		$deleteCategory = $cat->deleteCategory($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block">
			<?php
				if (isset($deleteCategory)) {
					echo $deleteCategory;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$showCat = $cat->showCategory();

						if ($showCat) {
							$i = 0;

							while ($result = $showCat->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td>
								<a href="catEdit.php?catId=<?php echo $result['catId']; ?>">Edit</a> ||
								<a onClick="return confirm('Are you want to delete')" href="?deleteId=<?php echo $result['catId']; ?>">Delete</a>
							</td>
						</tr>
					<?php
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>