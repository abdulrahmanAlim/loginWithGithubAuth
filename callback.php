<?php
session_start();
require "init.php";
require 'dbconfig/config.php';
fetchData();
if(!isset($_SESSION['user'])) {
	header("location: index.php");
}

$username = $_SESSION['user'];
$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Details</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>	
<body style="margin-top: 100px;">
	<div  class="main-wrapper">
		<h1 style="text-align: center;">Your have Successfully Authenticated Via Github</h1>
		<h2 style="text-align: center;">Please Press Next to contiune Configuring Your Account</h2>
		<center>
			<a href="registerpage.php"><button class="signup-btn" type="submit">Next</button></a>
		</center>
	</div>

</body>
</html>