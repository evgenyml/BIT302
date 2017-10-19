<!DOCTYPE html>
				  <?php
			include("config.php");
			session_start();
			
			
			
			if (isset($_POST['submit'])) {
				
				
			
				$username = $_POST['username'];
				$password = $_POST['password'];
		
				$query = "SELECT * FROM account WHERE username='$username' AND password='$password'";
				$result = mysqli_query($cxn, $query);

				$num_rows = mysqli_num_rows($result);
				 
				if ($num_rows == 1) {
					$_SESSION['login_user'] = $username;
					
					$row = mysqli_fetch_array($result);
					$branch_id = $row["branch_id"];
					
					header("location: main.php");
				}
				else {
						$errMsg = "Incorrect input. Please try again";
				}
			}
			
		?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="login.css">
		<title>Welcome to ShopSmart</title>
	</head>
	<body>
		<div id="logo" style="text-align:center; margin-top:100px;"><span style="font-family:Impact; font-size:80px; color:orange; font-style:italic;">ShopSmart</span></div>
		<div class="loginform">
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			Username: 
			<input type="text" name="username" id="username"><br><br>
			Password:
			<input type="password" name="password" id="password"><br><br>
			<input type="submit" name="submit" value="Login">
		</form>
		<br>
		<div><span style="color:red;"><?php if ( isset($errMsg) ) {echo $errMsg; } ?></span></div>
		</div>
		
	</body>
</html>