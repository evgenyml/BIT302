<!DOCTYPE html>
<?php session_start(); ?>
<html>
	<head>
		<title>ShopSmart</title>
		<link rel="stylesheet" type="text/css" href="style.css"></link>
	</head>
	<body>
		<div class="header">
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
			<table class="product" style="display:block; clear:both;">
				<?php
					$productID = $_GET['pid'];
							
					$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
					$query = mysqli_query($cxn, "SELECT * FROM product INNER JOIN store ON product.storeID=store.storeID WHERE product.productID='$productID'");
							
					$row = mysqli_fetch_array($query);
					$productName = $row['productName'];
					$price = $row['price'];
					$numStock = $row['numberInStock'];
					$storeName = $row['storeName'];
					$address= $row['address'];
							
					echo 	"<h2 style=\"text-align:center;\">$productName</h2>
							<tr>
								<td>price:</td>
								<td style=\"text-align:right;\">$price</td>
							</tr>
							<tr>
								<td>Number in stock:</td>
								<td style=\"text-align:right;\">$numStock</td>
							</tr>
							<tr>
								<td>Store:</td>
								<td style=\"text-align:right;\">$storeName</td>
							</tr>
							<tr>
								<td>Address: </td>
								<td style=\"text-align:right;\">$address</td>
							</tr>";
					mysqli_close($cxn);
				?>
			</table>
			<div id="comments">
				<h3>User Comments</h3>
				<?php
					$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
					$query = mysqli_query($cxn, "SELECT * FROM comment WHERE productID=$productID");
				
					while($row = mysqli_fetch_array($query)) {
						$author = $row["author"];
						$comment= $row["comment"];
						$date= $row["date"];
						
						echo 	"<div class=\"comment\">
									<h3 style=\"font-family:Times New Roman; float:left; clear:both; color:#148727;\">$author</h3>
									<p style=\"clear:both;\">$comment</p>
									<p style=\"text-align:right;\">$date</p>
								</div>";
								// <span style=\"float:right;\">$date</span>
					}
					mysqli_close($cxn);
				?>							
			</div>
			<div id="commentform">
				<form method="POST" action="comment.php?pid=<?php echo $productID; ?>">
					<br><label for="comment">Leave a comment:</label><br><br>
					<textarea name="comment" id="comment" rows="8" cols="100"></textarea><br><br>
					<input type="submit" name="submit" value="Submit">
				</form>
			</div>				
		</div>
</body>
</html>