<?php 

	include_once('includes/session.php');

	if(isset($_POST['edit']))
	{
		$conn = $pdo->open();

		try
		{
			$id = $_GET['id'];
			$category = $_POST['name'];

			$sql = "UPDATE productclass_tbl SET product_class = '$category' WHERE productClass_id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $conn->exec($sql) ) ? 'Member updated successfully' : 'Something went wrong. Cannot update member';

		}
		catch(PDOException $e)
		{
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$pdo->close();
	}
	else
	{
		$_SESSION['message'] = 'Fill up edit form first';
	}

	header('location: category.php');

?>