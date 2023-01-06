<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_GET['id'];
		$firstname = $_POST['admin_uname'];
		$password = $_POST['admin_pass'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM admin_tbl WHERE admin_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if($password == $row['admin_pass']){
			$password = $row['admin_pass'];
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		try{
			$stmt = $conn->prepare("UPDATE admin_tbl SET admin_username=:firstname, admin_password=:password WHERE admin_id=:id");
			$stmt->execute(['firstname'=>$firstname, 'password'=>$password, 'id'=>$id]);
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

	header('location: user_admin.php');

?>