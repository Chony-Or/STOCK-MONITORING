<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM productclass_tbl WHERE product_class=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Category already exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO productclass_tbl (product_class) VALUES (:name)");
				$stmt->execute(['name'=>$name]);
				$_SESSION['success'] = 'Category added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up category form first';
	}

	header('location: category.php');

?>