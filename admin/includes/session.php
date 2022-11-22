<?php
	include '../includes/connection.php';
	session_start();

	if(!isset($_SESSION['admin_login']) || trim($_SESSION['admin_login']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM  WHERE admin_id=:id");
	$stmt->execute(['id'=>$_SESSION['admin_login']]);
	$admin = $stmt->fetch();

	$pdo->close();

?>