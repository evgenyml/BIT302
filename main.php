<!DOCTYPE html>


<html>
	<head>
		<title>ShopSmart</title>
		
	</head>
	<body>
		<div class="logout">
			<span style="float:right;">
				<a href="logout.php" style="color:white; background-color:black; border-radius:10px; padding: 5px 10px;text-decoration:none;font-size:20px;font-weight:bold;">Logout</a>
			</span>
		<div id="logo" style="text-align:center; margin-top:10px;"><span style="font-family:Impact; font-size:80px; color:orange; font-style:italic;">ShopSmart</span></div>

		<div class="searchform">
		<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		
			<label for="product">Enter product name:</label><input type="text" name="product" id="product">
			<input type="submit" name="search" value="search">
		</form>
		<table class="producttable">
		<?php
			if (isset($_GET['search'])) {
				
				echo "<tr>
						<th>Product</th>
						<th>Price</th>
					</tr>";
				$product = $_GET['product'];
				$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
				$query = mysqli_query($cxn, "SELECT * FROM product WHERE productName LIKE '%$product%'");
				while($row = mysqli_fetch_array($query)) {
					$name = $row['productName'];
					$price = $row['price'];
					echo "<tr>
							<td>$name</td>
							<td>$price</td>
						<tr>";
				}
				
			mysqli_close($cxn);	
				
			}
		?>
		</table>
		</div>
	</body>
</html>