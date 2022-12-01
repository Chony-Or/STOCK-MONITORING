<?php include_once('includes/session.php');

	if(isset($_POST['edit'])){

		$conn = $pdo->open();
		try{
			$id = $_GET['id'];
			$firstname = $_POST['firstname'];

			$sql = "UPDATE admin_tbl SET admin_username = '$firstname' WHERE admin_id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $conn->exec($sql) ) ? 'Member updated successfully' : 'Something went wrong. Cannot update member';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$pdo->close();
	}
	else{
		$_SESSION['message'] = 'Fill up edit form first';
	}

	header('location: user.php');

?>