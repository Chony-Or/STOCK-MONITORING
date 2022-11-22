<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	if(isset($_POST['login']))
	{
		$username = $_POST['type_usernmae'];
		$password = $_POST['type_password'];

		try
		{
			$stmt = $conn->prepare("SELECT * FROM admin_tbl WHERE admin_username=:admin_username");
			$stmt->execute(['admin_username'=>$username]);
			$row = $stmt->fetch();
			
			if($row['numrows'] > 0)
			{
				if($username==$row["admin_username"])
				{
					if(password_verify($password, $row['admin_password']))
					{
						$_SESSION['admin_login'] = $row['admin_login'];
					}
					else
					{
						$_SESSION['error'] = 'Incorrect Password';
					}
				}
				else
				{
					$_SESSION['error'] = 'Account not activated.';
				}
			}
			else
			{
				$_SESSION['error'] = 'Username not Found';
			}
		}
		catch(PDOException $e)
		{
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else
	{
		$_SESSION['error'] = 'Input login credentials first';
	}

	$pdo->close();

	header('location: login.php');
?>