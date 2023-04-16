<?php

	// Calling for the connection
	include '../includes/connection.php';
	
	// The following user session that will login will start
	session_start();
	
	if(!isset($_SESSION['admin_login'])) //check unauthorize user not access in "dashboard.php" page
	{
		//head back to login.php if login attempt failed
		header("location: login.php");
	}
	
	//connection to database
	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT * FROM admin_tbl WHERE admin_id=:uid");
	$stmt->execute(['uid'=>$_SESSION['admin_login']]);
	$admin = $stmt->fetch();
	
	$pdo->close();

?>