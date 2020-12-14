<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
	$brand = new Brand();

	if (isset($_GET['deleteId'])) {
		$id = $_GET['deleteId'];

		$deleteBrand = $brand->deleteBrand($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Brand List</h2>
		<div class="block">
			<?php
				if (isset($deleteBrand)) {
					echo $deleteBrand;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Brand Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
            <?php
              $showBrand = $brand->showBrand();

              if ($showBrand->num_rows > 0) {
                $i = 0;

                while ($result = $showBrand->fetch_assoc()) {
                  $i++;
            ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td>
								<a href="brandEdit.php?brandId=<?php echo $result['brandId']; ?>">Edit</a> ||
								<a onClick="return confirm('Are you watn to delete')" href="?deleteId=<?php echo $result['brandId']; ?>">Delete</a>
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