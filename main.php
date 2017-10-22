<!DOCTYPE html>


<html>
	<head>
		<title>ShopSmart</title>
		<style type="text/css">
		
		body {
			background-color:grey;
			font-family:Cooper Black;
		}
		.producttable {
			margin:50px auto;
			padding:10px;
			font-size:20px;
			font-family:Cooper Black;
			
			
		}
		
		.producttable td {
			padding:5px;
		}
		.producttable th {
				background-color:#3366cc;
				text-align:left;
				
		}
			
		input[type="submit"] {
			font-size:15px;
			font-weight:bold;
			color:white;
			background-color:black;
			border:none;
			border-radius:25px;
			padding:5px;
			width:100px;
		}
		</style>
		
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
				

				$product = $_GET['product'];
				$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
				$query = mysqli_query($cxn, "SELECT product.productName, product.price, store.storeName, store.address FROM product INNER JOIN store ON product.storeID=store.storeID WHERE product.productName LIKE '%$product%' AND numberInStock>0");
				
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
					
					$name = $row['productName'];
					$price = $row['price'];
					$store = $row['storeName'];
					$address = $row['address'];
					echo "<tr>
							<td>$name</td>
							<td>$price</td>
							<td>$store</td>
							<td>$address</td>
						<tr>";
				}
				
				if ($counter==0)
					echo "Sorry, no matching products found";
				
			mysqli_close($cxn);	
				
			}
		?>
		</table>
		</div>
	</body>
</html>
