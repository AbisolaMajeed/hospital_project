<?php 

		session_start();

		include('../db/authentication.php');

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Patient Invoices</title>
</head>
<body>

		<h1>Celine Hospital</h1>
		<h1>Patient Invoices</h1>
		<p><b>All fields are required</b></p>

			<?php 

				if(isset($_POST['submit']))
				{
					$error = array();

					if(empty($_POST['regnumber'])){
						$error = "*";
					} else{
						$regnumber = mysqli_real_escape_string($db, trim($_POST['regnumber']));
					}

					if(empty($_POST['name'])){
						$error = "*";
					} else {
						$name = mtsqli_real_escape_string($db, trim($_POST['name']));
					}

					if(empty($_POST['age'])){
						$error = "*";
					} else {
						$age = mtsqli_real_escape_string($db, trim($_POST['age']));
					}

					if(empty($_POST['medicine'])){
						$error = "*";
					} else {
						$medicine = mtsqli_real_escape_string($db, trim($_POST['medicine']));
					}

					if(empty($_POST['doctor'])){
						$error = "*";
					} else {
						$doctor = mtsqli_real_escape_string($db, trim($_POST['doctor']));
					}

					if(empty($_POST['service'])){
						$error = "*";
					} else{
						$service = mysqli_real_escape_string($db, trim($_POST['service']));
					}

					if(empty($error))
					{

						$regumber = range(050, 1000);
						

						$total = ($medicine + $doctor + $service);

						// $invoice_no = range(10, 5000);

								for($invoice_no = 10; $invoice_no<=5000; $invoice_no++)
								{
									if(($invoice_no%10) == 0);
								}
										
							$insert = mysqli_query("INSERT INTO invoice
													VALUES(NULL,
															'".$invoice_no."',
															NOW(),
															'".$regnumber."',
															'".$name."',
															'".$medicine."',
															'".$doctor."',
															'".$service."',
															'".$total."'
													)") or die(mysqli_error($db));

							echo "Added Successfully";
					}
					
				}


			 ?>

		<form action="" method="post"></form>

		<p>Patient Reg No:<br>
			<input type="text" name="regnumber"></p>

		<p>Patient Full Name:<br>
			<input type="text" name="name"></p>

		<p>Patient Age:<br>
			<input type="text" name="age"></p>

		<p>Medicine Charge<br>
			<input type="text" name="medicine" placeholder="Medicine Charge"></p>

		<p>Doctor Charge<br>
			<input type="text" name="doctor" placeholder="Doctor Charge"></p>

		<p>Service Charge<br>
			<input type="text" name="service" placeholder="Service Charge"></p>

			<input type="submit" name="submit">

</body>
</html>