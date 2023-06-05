<?php
    
    include_once('includes/session.php');

	if(isset($_GET['id']))
    {
        $conn = $pdo->open();
		
        try
        {
			$sql = "DELETE FROM customer_tbl WHERE customer_id = '".$_GET['id']."'";
			
            //if-else statement in executing our query
			$_SESSION['message'] = ( $conn->exec($sql) ) ? 'Member deleted successfully' : 'Something went wrong. Cannot delete member';
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
		$_SESSION['message'] = 'Select member to delete first';
	}

	header('location: user_regular.php');

?>