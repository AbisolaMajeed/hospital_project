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
	<title>Patient Registration</title>
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

		<hr>


			<h2>Patient Registration Form</h2>
			<p><b>All fields are required</b></p>

			<?php

				if(isset($_POST['submit']))
				{
					$error = array();

					if(empty($_POST['fname'])){
						$error['fname'] = "*";
					} else{
						$fname = mysqli_real_escape_string($db, trim($_POST['fname']));
					}

					if(empty($_POST['lname'])){
						$error['lname'] = "*";
					} else{
						$lname = mysqli_real_escape_string($db, trim($_POST['lname']));
					}

					if(empty($_POST['address'])){
						$error['address'] = "*";
					} else{
						$address = mysqli_real_escape_string($db, trim($_POST['address']));
					}

					if(empty($_POST['number'])){
						$error['number'] = "*";
					} else{
						$number = mysqli_real_escape_string($db, trim($_POST['number']));
					}

					if(empty($_POST['email'])){
						$error['email'] = "*"; 
					} else {
						$email = mysqli_real_escape_string($db, trim($_POST['email']));
					}

					if(empty($_POST['gender'])){
						$error['gender'] = "*";
					} else{
						$gender = mysqli_real_escape_string($db, trim($_POST['gender']));
					}

					if(empty($_POST['date'])){
						$error['date'] = "*";
					} else{
						$date = mysqli_real_escape_string($db, trim($_POST['date']));
					}

					if(empty($_POST['bloodgroup'])){
						$error['bloodgroup'] = "*";
					} else{
						$bloodgroup = mysqli_real_escape_string($db, trim($_POST['bloodgroup']));
					}

					if(empty($_POST['fullname'])){
						$error['docname'] = "*";
					} else{
						$fullname = mysqli_real_escape_string($db, trim($_POST['fullname']));
					}



					if(empty($error))
					{


						$insert = mysqli_query($db, "INSERT INTO patient
													VALUES(NULL,
															'".$fname."',
															'".$lname."',
															'".$fullname."',
															'".$date."',
															'".$address."',
															'".$number."',
															'".$email."',
															'".$gender."',
															'".$bloodgroup."',
															'".$regnumber."'
															)") or die(mysqli_error($db));
						echo "<h3>Added Successfully!!!</h3>";

					}
				}

			?>

			<form action="" method="post">

			<p><input type="fname" name="fname" placeholder="First Name"
				value="<?php if(isset($fname)) echo $fname?>">
				<?php if(isset($error['fname'])) echo $error['fname']?>
			</p>

			<p><input type="lname" name="lname" placeholder="Last Name"
				value="<?php if(isset($lname)) echo $lname?>">
				<?php if(isset($error['lname'])) echo $error['lname']?>
			</p>

			<p>
		<textarea name="address" placeholder="Address" rows="5" cols="30"><?php if(isset($address)) echo $address?></textarea>
				<?php if(isset($error['address'])) echo $error['address']?>	
			</p>

			<?php $docname = array($fullname)?>
			<p>
				<select name="fullname">
					<option value="">Select Doctor</option>
					<?php foreach($docname as $docname){?>
					<option value="<?php echo $docname?>" <?php if(isset($fullname) && ($fullname == $docname))
					echo 'selected="selected"'?>>
					<?php echo $docname?>

					<?php }?>
					</option>

				</select> <?php if(isset($error['docname'])) echo $error['docname']?>
			</p>

			<p><input type="text" name="number" placeholder="Contact Number" maxlength="11"
				value="<?php if(isset($_POST['number'])) echo $_POST['number']?>">
				<?php if(isset($error['number'])) echo $error['number']?>
			</p>

			<p><input type="email" name="email" placeholder="Email Address"
				value="<?php if(isset($_POST['email'])) echo $_POST['email']?>">
				<?php if(isset($error['email'])) echo $error['email']?>
			</p>

			<p><select name="gender">

				<option value="">Select your Gender</option>
				<option <?php if(isset($gender) && ($gender == "Male"))
				echo 'selected="selected"'?>>Male</option>

				<option <?php if(isset($gender) && ($gender == "Female"))
				echo 'selected="selected"'?>>Female</option>
			</select><?php if(isset($error['gender'])) echo $error['gender']?>
			</p>

			<p>Birthday<br>
				<input type="date" name="date" value="<?php if(isset($_POST['date'])) echo $_POST['date']?>">
				<?php if(isset($error['date'])) echo $error['date']?>
			</p>

			<p><select name="bloodgroup">
				<option value="">Select Blood Group</option>

				<option <?php if(isset($bloodgroup) && ($bloodgroup == "A"))
				echo 'selected="selected"'?>>A</option>

				<option <?php if(isset($bloodgroup) && ($bloodgroup == "B"))
				echo 'selected="selected"'?>>B</option>

				<option <?php if(isset($bloodgroup) && ($bloodgroup == "AB"))
				echo 'selected="selected"'?>>AB</option>

				<option <?php if(isset($bloodgroup) && ($bloodgroup == "O"))
				echo 'selected="selected"'?>>O</option>	
			</select> <?php if(isset($error['bloodgroup'])) echo $error['bloodgroup']?>
			</p>
			
			<p><input type="submit" name="submit"></p>			
				

			</form>








</body>
</html>