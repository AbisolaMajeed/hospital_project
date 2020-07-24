<?php

	session_start();
	include('../db/authentication.php');

	authenticate();

	$fullname = $_SESSION['fullname'];
	$username =$_SESSION['username'];
	$docname = $_SESSION['fullname'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>View Patient</title>
</head>
<body>


		<h1>Celine Hospital</h1>
		<p><b>Hospital Management System</b></p>

		<hr>

		<h2>Welcome<?php echo "<b>  $username</b>"?>!!!</h2>

		<?php

			echo "<p><b>Admin Name</b>: $fullname</p>";
	
		?>
		
		<hr>

			<a href="admin_home.php">Home</a>
			<a href="logout.php">Logout</a>
			<a href="patient_register.php">Add Patient</a>
			<a href="view_patient.php">Patient List</a>

		<hr>

		<?php $select = mysqli_query($db, "SELECT * FROM patient
										   WHERE docname = '".$fullname."'
											") or die(mysqli_error($db)) ?>

		<table border="1">

			<tr>
				<th>S.No</th>
				<th>Name</th>
				<th>Doctor's Name</th>
				<th>Date of Birth</th>
				<th>Address</th>
				<th>Phone Number</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Bloodgroup</th>
			</tr>

			<tr>

				<?php while($result = mysqli_fetch_array($select)){ ?>

				<td><?php echo $result[0] ?></td>
				<td><?php echo $result[1].' '.$result[2] ?></td>
				<td><?php echo $result[3] ?></td>
				<td><?php echo $result[4] ?></td>
				<td><?php echo $result[5] ?></td>
				<td><?php echo $result[6] ?></td>
				<td><?php echo $result[7] ?></td>
				<td><?php echo $result[8] ?></td>
				<td><?php echo $result[9] ?></td>


			</tr>

			<?php }?>

		</table>





</body>
</html>