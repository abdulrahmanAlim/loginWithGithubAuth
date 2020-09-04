<?php
session_start();
require "init.php";
require 'dbconfig/config.php';

if(isset($_SESSION['user'])) {
	header("location: callback.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="background-color: #ecf0f1">

	<div class="main-wrapper">
		<center><h2>Login</h2></center>
	

	<form class="main-form" action="index.php" method="post">

		<label class="label-txt">Login using Your Email or Username</label>
		<input type="text" name="login_input" placeholder="Enter your Email or Username" class="input-form"><br>

		<label class="label-txt">Password</label>
		<input type="password" name="password" placeholder="Enter your Password" class="input-form"><br>

		<center>
			<button class="login-btn" name="login_btn" type="submit">Login</button>
			<a href="login.php"><input  type="button" class="register-btn" value="Login with github"></a>
		</center>
		
	</form>

	<?php

	if(isset($_POST['login_btn']))
	{
		$login_input = $_POST['login_input'];
		$password = $_POST['password'];

		$query= " select * from users WHERE ( username='$login_input' OR email = '$login_input') AND password='$password' ";
		$query_run= mysqli_query($con , $query);

		if(mysqli_num_rows($query_run)> 0) 
		{
			 while($row = $query_run->fetch_assoc()) {                    
   			 $username=$row['username'];
   			 $_SESSION['username'] = $username;
			 header('location:welcomepage.php');
			 }	
		}
		else
		{
			echo ' <script type="text/javascript"> alert("Invalid Email or Password") </script>';
		}
	}

	?>

	</div>

	
</body>
</html>