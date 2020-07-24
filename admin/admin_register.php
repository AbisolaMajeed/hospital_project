<?php 

	session_start();
	include('../db/db_config.php');

	// $select = mysqli_query($db, "SELECT username FROM admin");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Registration</title>
	<link rel="stylesheet" type="text/css" href="../css/reg.css">
</head>
<body>


		<?php

			if(isset($_POST['submit']))
			{
				$error = array();
				if(empty($_POST['fullname'])){
					$error['fullname'] = "*";
				} else {
					$fullname = mysqli_real_escape_string($db, trim($_POST['fullname']));
				}
				
				if(empty($_POST['email'])){
					$error['email'] = "*";
				} else{
					$email = mysqli_real_escape_string($db, trim($_POST['email']));
				}
				if(empty($_POST['password'])){
					$error['password'] = "*";
				} else{
					$password =mysqli_real_escape_string($db,trim($_POST['password']));
				}
				if(empty($_POST['pword'])){
					$error['pword'] = "*";
				} else if($_POST['password'] === $_POST['pword']){
					$pword = md5(mysqli_real_escape_string($db,trim($_POST['pword'])));
				} else {
					$error['pword'] = "*";
				}

				if(empty($_POST['username'])){
					$error['username'] = "*";
				} else {
					$username = mysqli_real_escape_string($db, trim($_POST['username']));

				$select = mysqli_query($db, "SELECT username FROM admin") or die(mysqli_error($db));

				while($result = mysqli_fetch_array($select)) {
				if(in_array("$username", $result)) {
					$error['username'] = "* Username already exists";
					}
					
					// $_SESSION['username'] = $result['username'];
					// $_SESSION['password'] = $result['password'];
					}
				}
				if(empty($error))
				{

				$query = mysqli_query($db,"INSERT INTO admin
											VALUES(NULL,
													'".$fullname."',
													'".$username."',
													'".$email."',
													'".$password."',
													'".$pword."'
													)") or die(mysqli_error($db));

					echo "<h5>Registered Successfully!!!</h5>";

					header("location:admin_login.php");
				} 

			}

		?>



		<header>
		<h1>Celine Hospital</h1>
		<h2>Hospital Management System</h2>
		</header>

	<div id="container">

	<h3>Admin Registration Form</h3>

	<span><p><b> All fields are required</b></p></span>
	

	<form action="" method="post">


		<p><label><input type="text" name="fullname" placeholder="Full Name"
			value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname']?>"/></label>
			<?php if(isset($error['fullname'])) echo $error['fullname']?>
		</p>
		<p><label><input type="text" name="username" placeholder="Username"
			value="<?php if(isset($_POST['username'])) echo $_POST['username']?>"/></label>
			<?php if(isset($error['username'])) echo $error['username']?>
		</p>
		<p><label><input type="email" name="email" placeholder="Email"
			 value="<?php if(isset($_POST['email'])) echo $_POST['email']?>"/></label>
			 <?php if(isset($error['email'])) echo $error['email']?>
		</p>
		<p><label><input type="password" name="password" placeholder="Password"/></label>
			<?php if(isset($error['password'])) echo $error['password']?>
		</p>
		<p><label><input type="password" name="pword" placeholder="Confirm Password"></label>
			<?php if(isset($error['pword'])) echo $error['pword']?>
		</p>
		<p><input type="submit" name="submit" value="SUBMIT"></p>

		<footer><p>Press Submit button after completing</p></footer>

		<!-- <p>Already registered? <a href="admin_login.php">Login</a></p> -->

		</div>


	</form>

</body>
</html>