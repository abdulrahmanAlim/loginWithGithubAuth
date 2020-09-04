<?php
require 'dbconfig/config.php';
session_start();
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
		<h2 style="text-align: center;">Please Enter Your Password for Our System</h2>

		<form class="main-form" action="registerpage.php" method="post">

		<!-- <label>Username</label>
		<input type="text" name="username" class="input-form" value="<?php echo (isset($username))?$username:'';?>"><br>
		<label>Email</label>
		<input type="text" name="email" class="input-form" value="<?php echo (isset($email))?$email:'';?>"> <br> -->
		<label>Password</label>
		<input type="password" name="password" class="input-form"><br>
		<label>Confirm Password</label>
		<input type="password" name="confirmpassword" class="input-form"><br>

		<center>
			<a href="index.php"><input class="backto-btn" type="button" value="Back to Login Page"></button></a>
			<button class="signup-btn" name="submit_btn" type="submit">Submit</button>
		</center>
		</form>

		<?php 
		if(isset($_POST['submit_btn']))
		{

			$username = $_SESSION['user'];
			$email = $_SESSION['email'];
			$password = $_POST['password'];
			$confirmpassword = $_POST['confirmpassword'];

			if($password==$confirmpassword) 
			{
				$query= "select * from users WHERE username ='$username' ";

				$query_run = mysqli_query($con , $query);

				if(mysqli_num_rows($query_run)>0)
				{
					echo ' <script type="text/javascript"> alert("User already Exists, Try with Different name") </script>';
				}
				else
				{
					$query= "insert into users values('$username' ,'$email' ,'$password')";
					$query_run = mysqli_query($con ,$query);

					if($query_run) 
					{
						echo ' <script type="text/javascript"> alert("User Registered Successfully") </script>';
						$_SESSION['username']=$username;
						header('location:welcomepage.php');
					} 
					else 
					{
						echo ' <script type="text/javascript"> alert("Erorr Registering a User") </script>';
					}
				}
			}
			else 
			{
				echo ' <script type="text/javascript"> alert("Check your Confirmation Password") </script>';
			}
		}

	?>
	</div>
</body>
</html>