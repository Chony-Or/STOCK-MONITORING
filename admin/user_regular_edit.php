<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_GET['id'];
		$customer = $_POST['rName'];
    	$address = $_POST['rAddress'];
    	$contact = $_POST['rContact'];
    	$password = $_POST['rPassword'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM customer_tbl WHERE customer_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($password == $row['rPassword']){
			$password = $row['rPassword'];
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		try{
			$stmt = $conn->prepare("UPDATE customer_tbl SET customer_name=:cname, customer_address=:caddress, customer_contactNo=:ccontact, customer_password=:cpassword WHERE customer_id=:id");
			$stmt->execute(['cname'=>$customer, 'caddress'=>$address, 'ccontact'=>$contact, 'cpassword'=>$password, 'id'=>$id]);
			$_SESSION['success'] = 'User updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit user form first';
	}

	header('location: user_regular.php');
