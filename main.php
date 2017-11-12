<!DOCTYPE html>

<?php session_start(); ?>
<html>
	<head>
		<title>ShopSmart</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="header">
			<div class="logout">
				<span style="float:right;">
					Hello, <?php echo $_SESSION['login_user']; ?><a href="logout.php" style="color:white; background-color:black; border-radius:10px; padding: 5px 10px;text-decoration:none;font-size:20px;font-weight:bold; margin-left:5px; margin-right:5px;">Logout</a>
				</span>
			<div id="logo" style="text-align:center; margin-top:10px;"><span style="font-family:Impact; font-size:80px; color:orange; font-style:italic;">ShopSmart</span></div>
		</div>
			<div class="catmenu">
				<ul class="categories">
		
				<?php
					$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
					$query = mysqli_query($cxn, "SELECT * FROM category ORDER BY categoryName");
				
					while($row = mysqli_fetch_array($query)) {
					$categoryName = $row["categoryName"];
					$categoryId = $row["categoryID"];
					echo "<a href=\"category.php?cid=$categoryId\"><li>$categoryName</li></a>";
					
					}
		
					mysqli_close($cxn);
				?>
				</ul>
			</div>
			<div class="products">
				<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<label for="product">Enter product name:</label><input type="text" name="product" id="product">
					<label for="sort">Sort by:</label>
					<select name="sort">
						<option value="alphabet">Alphabet</option>
						<option value="price">Price</option>
					</select>
					<input type="submit" name="search" value="search">
				</form>
				<table class="producttable">
				<?php	
					if (isset($_GET['search'])) {
						
						$product = $_GET['product'];
						$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
						
						$order = $_GET['sort'];
						if ($order == "price")
							$query = mysqli_query($cxn, "SELECT product.productID, product.productName, product.price, store.storeName, store.address FROM product INNER JOIN store ON product.storeID=store.storeID WHERE product.productName LIKE '%$product%' AND numberInStock>0 ORDER BY product.price");
						else 
							$query = mysqli_query($cxn, "SELECT product.productID, product.productName, product.price, store.storeName, store.address FROM product INNER JOIN store ON product.storeID=store.storeID WHERE product.productName LIKE '%$product%' AND numberInStock>0 ORDER BY product.productName");
						
						$counter = 0;
						while($row = mysqli_fetch_array($query)) {
							$counter++;
							
							if ($counter==1)
							echo "<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Store</th>
								<th>Address</th>
							</tr>";
							
							$productID = $row['productID'];
							$name = $row['productName'];
							$price = $row['price'];
							$store = $row['storeName'];
							$address = $row['address'];
							echo "<tr>
									<td><a href=\"product.php?pid=$productID\">$name</a></td>
									<td>$price</td>
									<td>$store</td>
									<td>$address</td>
								<tr>";
								
						}
						
						if ($counter==0)
							echo "<tr>
								<td colspan=\"4\" style=\"text-align:center;\">Sorry, no matching products found</td>
							</tr>";
							
					mysqli_close($cxn);	
						
					}
					
					else {
						$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
						$query = mysqli_query($cxn, "SELECT product.productID, product.productName, product.price, store.storeName, store.address FROM product INNER JOIN store ON product.storeID=store.storeID WHERE numberInStock>0 ORDER BY product.productID DESC LIMIT 5");
						
						$counter = 0;
						while($row = mysqli_fetch_array($query)) {
							$counter++;
							
							if ($counter==1) {
								echo "<tr>
								<td colspan=\"4\" style=\"text-align:center;\">New Products!!!!!</td>
							</tr>";
							echo "<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Store</th>
								<th>Address</th>
							</tr>";
							
							}
							
							$productID = $row['productID'];
							$name = $row['productName'];
							$price = $row['price'];
							$store = $row['storeName'];
							$address = $row['address'];
							echo "<tr>
									<td><a href=\"product.php?pid=$productID\">$name</a></td>
									<td>$price</td>
									<td>$store</td>
									<td>$address</td>
								<tr>";
								
						}
						mysqli_close($cxn);	
							
					}
				?>
				</table>
			</div>
	</body>
</html>
