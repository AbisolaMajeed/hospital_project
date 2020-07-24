<?php

	session_start();

	include('../db/db_config.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
		
		<!-- <p>Please Enter Admin Username and Password</p> -->

		<?php 

			if(isset($_POST['Submit']))
			{
				$error = array();

				if(empty($_POST['username']))
				{
					$error['username'] = "*";

				} else{

					$username = mysqli_real_escape_string($db, trim($_POST['username']));
				}
				if(empty($_POST['password'])){

					$error['password'] = "*";

				} else {

					$password =md5(mysqli_real_escape_string($db, trim($_POST['password'])));

				}

				if(empty($error))
				{
					$query = mysqli_query($db, "SELECT * FROM admin
										   WHERE username = '".$username."' AND secured_password = '".$password."'")
										   or die(mysqli_error($db));

					if(mysqli_num_rows($query) == 1) {
					$result = mysqli_fetch_array($query);

					 $_SESSION['fullname'] = $result['fullname'];
					 $_SESSION['username'] = $result['username'];
					 $_SESSION['email'] = $result['email'];

					 header("location:admin_home.php");

					} else {
						$msg = "Invalid Username and(or) Password";
						header("location:admin_login.php?msg=$msg");
						
					}
				}
			}

			?>

			
			<label>
			<?php if(isset($_GET['msg'])) {

				echo "<p>".$_GET['msg']."</p>";
			}
			?></label>


		<header>
		<h1>Celine Hospital</h1>
		<h3>Hospital Management System</h3>
		</header>

		
		<form action="" method="post">

			
			<p><input type="text" name="username" placeholder="Username"
			value="<?php if(isset($_POST['username'])) echo $_POST['username']?>"/>
			<span><?php if(isset($error['username'])) echo $error['username']?></span>
			</p>

			<p><input type="password" name="password" placeholder="Password"/>
			<span><?php if(isset($error['password'])) echo $error['password']?></span>
			</p>
			<p><input type="submit" name="Submit" value="SUBMIT"></p>
				<div><a href="admin_register.php"> Not registered yet?</a></div>

		</form>
		
</body>
</html>