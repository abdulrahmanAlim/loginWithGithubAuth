<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="background-color: #ecf0f1">

	<div class="main-wrapper">
		<center>
			<h2>Welcome 

			<?php
				echo $_SESSION['username'];
			?>
			</h2>
			
		</center>
	

	<form class="main-form" action="welcomepage.php" method="post">

		<center>
			<input name="logout_btn" class="logout-btn" type="submit" value="Log out"></button>
		</center>
		
	</form>

	<?php
		if(isset($_POST['logout_btn']))
		{
			session_destroy();
			header('location:index.php');
		}
	?>
	</div>
</body>
</html>