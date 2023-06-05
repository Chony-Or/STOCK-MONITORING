<?php

	include 'includes/session.php';

	if(isset($_POST['edit']))
    {
	    $id = $_GET['id'];
		$customer_fname = $_POST['rFName'];
		$customer_lname = $_POST['rLName'];
		$customer_uname = $_POST['rUName'];
		$contact = $_POST['rContact'];
    	$address_hn = $_POST['rAddressHn'];
		$address_st = $_POST['rAddressSt'];
		$address_city = $_POST['rAddressCity'];
    	$password = $_POST['rPassword'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM customer_tbl WHERE customer_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($password == $row['rPassword'])
        {
			$password = $row['rPassword'];
		}

		else
        {
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		try
        {
			$stmt = $conn->prepare("UPDATE customer_tbl SET customer_firstname=:cfname, customer_lastname=:clname, customer_username=:cuname, customer_contactNo=:ccontact, customer_houseno=:caddresshn, customer_street=:caddressst, customer_city=:caddresscity, customer_password=:cpassword WHERE customer_id=:id");
			$stmt->execute(['cfname'=>$customer_fname, 'clname'=>$customer_lname, 'cuname'=>$customer_uname, 'ccontact'=>$contact, 'caddresshn'=>$address_hn, 'caddressst'=>$address_st, 'caddresscity'=>$address_city, 'cpassword'=>$password, 'id'=>$id]);
			$_SESSION['success'] = 'User updated successfully';
		}

		catch(PDOException $e)
        {
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}

	else
    {
		$_SESSION['error'] = 'Fill up edit user form first';
	}

	header('location: user_regular.php');

?>