<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if (isset($_GET['cartId'])) {
		$cartIdGetMethod = $_GET['cartId'];

		$deleteProductCart = $cart->deleteProductCart($cartIdGetMethod);
	}
?>
<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];

		$updateProductQuantity = $cart->updateProductQuantity($cartId, $quantity);

		if ($quantity <= 0) {
			$deleteProductCart = $cart->deleteProductCart($cartId);
		}
	}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
				<?php
					if (isset($updateProductQuantity)) {
						echo $updateProductQuantity;
					}
				?>
				<?php
					if (isset($deleteProductCart)) {
						echo $deleteProductCart;
					}
				?>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
						$productCart = $cart->getProductCart();

						if ($productCart) {
							$subTotal = 0;

							while ($result = $productCart->fetch_assoc()) {
					?>
							<tr>
								<td><?php echo $result['productName']; ?></td>
								<td>
									<img src="./admin/uploads/<?php echo $result['image'] ?>" alt="" />
								</td>
								<td><?php echo $result['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value=<?php echo $result['cartId'] ?> />
										<input type="number" name="quantity" value=<?php echo $result['quantity'] ?> min="1" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td>
									<?php
										$totalPrice = $result['price'] * $result['quantity'];

										echo $totalPrice;
									?>
								</td>
								<td><a href="?cartId=<?php echo $result['cartId'] ?>">X</a></td>
							</tr>
					<?php
								$subTotal += $totalPrice;
							}
						}
					?>
				</table>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td><?php echo $subTotal; ?></td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td>10%</td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td><?php echo $subTotal + $subTotal * 0.1; ?></td>
					</tr>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="login.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>