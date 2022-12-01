<?php include 'includes/session.php';
 
	if(ISSET($_POST['add_regular'])){
		if($_POST['firstname'] != "" || $_POST['username'] != "" || $_POST['password'] != ""){
			try{
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO `member` VALUES ('', '$firstname', '$lastname', '$username', '$password')";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
	
			$conn = null;
			header('location:index.php');
		}else{
			echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'registration.php'</script>
			";
		}
	}
?>