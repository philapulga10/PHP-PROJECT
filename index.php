<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
				$productFeathered = $product->getProductFeathered();

				if ($productFeathered) {
					$i = 0;
					
					while($result = $productFeathered->fetch_assoc()) {
						$i++;
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="detail.php">
						<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" />
					</a>
					<h2><?php echo $result['productName'] ?></h2>
					<p><?php echo $fm->textShorten($result['productDescription'], 50) ?></p>
					<p>
						<span class="price"><?php $result['price'] ?></span>
					</p>
					<div class="button">
						<span>
							<a href="detail.php" class="details">Details</a>
						</span>
					</div>
				</div>
			<?php
					}
				}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
				$newProduct = $product->getNewProduct();

				if ($newProduct) {
					$i = 0;

					while ($result = $newProduct->fetch_assoc()) {
						$i++;
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="detail.php">
					<img src="./admin/uploads/<?php echo $result['image'] ?>" alt="" />
				</a>
				<h2><?php echo $result['productName'] ?></h2>
				<p>
					<span class="price"><?php echo $result['price'] ?></span>
				</p>
				<div class="button">
					<span>
						<a href="detail.php?productId=<?php echo $result['productId'] ?>" class="details">Details</a>
					</span>
				</div>
			</div>
			<?php
					}
				}
			?>
		</div>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>