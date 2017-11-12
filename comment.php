<?php

session_start();

$author = $_SESSION['login_user'];

if (isset($_POST['submit'], $_GET['pid'])) {
	$id = $_GET['pid'];
	$comment = $_POST['comment'];
	$today = date("Y-m-d");
	
	$cxn = mysqli_connect('localhost', 'root', '', 'shopsmart') or die ('Could not connect');
	$query = mysqli_query($cxn, "INSERT INTO comment(author, productID, comment, date) VALUES('$author', $id,'$comment', '$today')");
	
	mysqli_close($cxn);
	
	header("Location: product.php?pid=$id");
}

?>