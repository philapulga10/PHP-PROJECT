<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if (!isset($_GET['productId']) || $_GET['productId'] === NULL) {
		echo "<script>window.location.href = 'error.php'</script>";
	} else {
		$id = $_GET['productId'];

		$productDetail = $product->getProductDetail($id);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$quantity = $_POST['quantity'];

		$addToCart = $cart->addToCart($id, $quantity);
	}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="cont-desc span_1_of_2">
				<?php
					if ($productDetail) {
						$i = 0;

						while ($result = $productDetail->fetch_assoc()) {
							$i++;
				?>
					<div class="grid images_3_of_2">
						<img src="./admin/uploads/<?php echo $result['image']; ?>" alt="" />
					</div>
					<div class="desc span_3_of_2">
						<h2><?php echo $result['productName']; ?></h2>
						<p><?php echo $fm->textShorten($result['productDescription'], 100); ?></p>
						<div class="price">
							<p>Price: <span><?php echo $result['price']." "."VND"; ?></span></p>
							<p>Category: <span><?php echo $result['catName']; ?></span></p>
							<p>Brand:<span><?php echo $result['brandName'] ?></span></p>
						</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="quantity" value="1" />
								<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								<?php
									if (isset($addToCart)) {
										echo "<p style='color:red;font-size:18px;'>Product already added</p>";
									}
								?>
							</form>
						</div>
					</div>
					<div class="product-desc">
						<h2>Product Details</h2>
						<p><?php echo $fm->textShorten($result['productDescription'], 100); ?></p>
					</div>
				<?php
						}
					}
				?>
			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<li><a href="productbycat.php">Mobile Phones</a></li>
					<li><a href="productbycat.php">Desktop</a></li>
					<li><a href="productbycat.php">Laptop</a></li>
					<li><a href="productbycat.php">Accessories</a></li>
					<li><a href="productbycat.php#">Software</a></li>
					<li><a href="productbycat.php">Sports & Fitness</a></li>
					<li><a href="productbycat.php">Footwear</a></li>
					<li><a href="productbycat.php">Jewellery</a></li>
					<li><a href="productbycat.php">Clothing</a></li>
					<li><a href="productbycat.php">Home Decor & Kitchen</a></li>
					<li><a href="productbycat.php">Beauty & Healthcare</a></li>
					<li><a href="productbycat.php">Toys, Kids & Babies</a></li>
				</ul>
			</div>
		</div>
	</div>
	<?php
		include 'inc/footer.php';
	?>