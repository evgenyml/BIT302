<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $session_query = mysqli_query($db,"select username from account where username = '$user_check' ");
   
   $row = mysqli_fetch_array($session_query);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:main.php");
   }
?