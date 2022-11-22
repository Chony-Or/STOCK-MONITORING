<?php

include 'includes/connection.php';

session_start();

if(isset($_SESSION["admin_login"]))	//check condition user login not direct back to index.php page
{
	header("location: admin/dashboard.php");
}

?>