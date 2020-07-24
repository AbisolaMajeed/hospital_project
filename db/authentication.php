<?php
	
	include('db_config.php');

	function authenticate()
	{
		if(!isset($_SESSION['username'])){
			header("location:admin_login.php");
		}

		if(!isset($_SESSION['fullname']) && (!isset($_SESSION['email']))){
			header("location:admin_login.php");
		}
	}
	
?>