<?php

    include_once('includes/session.php');

    if(isset($_GET['id']))
    {
		
        $pdo_conn = $pdo->open();

		try
        {
			$sql = "DELETE FROM customer_tbl WHERE customer_id = '".$_GET['id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $pdo_conn->exec($sql) ) ? 'Reservation deleted successfully' : 'Something went wrong. Cannot delete reservation';
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
		$_SESSION['message'] = 'Select reservation to delete first';
	}

	header('location: user_guest.php');

?>