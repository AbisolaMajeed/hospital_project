<?php
	
	session_start();
	include('../db/authentication.php');
	// include('../db/db_config.php');
	
	authenticate();

	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];
	$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin | Home</title>
</head>
<body>

		<h1>Celine Hospital</h1>
		<p><b>Hospital Management System</b></p>

		<hr>

		<h2>Welcome<?php echo "<b>  $username</b>"?>!!!</h2>

		<?php

			echo "<p><b>Admin Name</b>: $fullname</p>";
			echo "<p><b>Email</b>: $email</p>";
		?>
		
		<hr>

			<a href="admin_home.php">Home</a>
			<a href="logout.php">Logout</a>
			<a href="patient_register.php">Add Patient</a>
			<a href="view_patient.php">Patient List</a>


</body>
</html>