<?php
				
				include '../includes/connection.php';
				
				session_start();

				if(!isset($_SESSION['admin_login']))	//check unauthorize user not access in "welcome.php" page
				{
					header("location: login.php");
				}
				
				$conn = $pdo->open();

				$stmt = $conn->prepare("SELECT * FROM admin_tbl WHERE admin_id=:uid");
				$stmt->execute(['uid'=>$_SESSION['admin_login']]);
				$admin = $stmt->fetch();

				$pdo->close();
            
?>