<!DOCTYPE html>

<?php
$firstNameErr = $lastNameErr = $usernameErr = $passwordErr = $emailErr = "";
$firstName = $lastName = $username = $password = $email = "";
$usernameExists = "";
$correct = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstname"])) {
		$firstNameErr = "First name is required";
		$correct = false;
	} else {
		$firstName = test_input($_POST["firstname"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
		$firstNameErr = "Only letters allowed";
		$correct = false;
		}
	}
	
	if (empty($_POST["lastname"])) {
		$lastNameErr = "Last name is required";
		$correct = false;
	} else {
		$lastName = test_input($_POST["lastname"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
			$lastNameErr = "Only letters allowed";
			$correct = false;
			}
	}
	
	if (empty($_POST["username"])) {
		$usernameErr = "username is required";
		$correct = false;
	} else {
		$username = test_input($_POST["username"]);
	}
	
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
		$correct = false;
	} else {
		$password = test_input($_POST["password"]);
	}
	
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
		$correct = false;
	} else {
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format";
		$correct = false;
		}
	}
	
	if ($correct) {
		$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
		
		"SELECT * FROM account WHERE userName='$username'";
		
		$query = mysqli_query($cxn, "SELECT * FROM account WHERE userName='$username'");
		$row = mysqli_fetch_array($query);
		if ($row != false) {
			$usernameErr = "Username already exists. Please pick another username";
		}
		else {
		$createAccount = mysqli_query($cxn, "INSERT INTO account VALUES('$username', '$password', '$firstName', '$lastName', '$email')");
		header("location: main.php");
		}
		
		
		mysqli_close($cxn);
	
	
	}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>



<html>
	<body>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			First Name: 
			<input type="text" name="firstname" id="firstname">
			<span class="error"><?php echo $firstNameErr;?></span>
			<br><br>
			Last Name: 
			<input type="text" name="lastname" id="lastname">
			<span class="error"><?php echo $lastNameErr;?></span>
			<br><br>
			Username: 
			<input type="text" name="username" id="username">
			<span class="error"><?php echo $usernameErr;?></span>
			<br><br>
			Password:
			<input type="password" name="password" id="password">
			<span class="error"><?php echo $passwordErr;?></span>
			<br><br>
			Email:
			<input type="text" name="email" id="email">
			<span class="error"><?php echo $emailErr;?></span>
			<br><br>
			<input type="submit" name="submit" value="Register">
		</form>
	</body>
</html>