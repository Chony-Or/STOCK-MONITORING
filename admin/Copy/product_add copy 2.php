<?php
include 'includes/session.php';

if (isset($_POST['submit'])) {
	$name = $_POST['product'];
	$code = $_POST['code'];
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$category = $_POST['category'];

	$target_dir = "../images"; //for picture uploading
	$image_path = $target_dir . basename($_FILES['photo']['name']);

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM product_tbl WHERE product_name=:name");
	$stmt->execute(['name' => $name]);
	$row = $stmt->fetch();

	if ($row['numrows'] > 0) {
		$_SESSION['error'] = 'Product already exist';
	} else {
		if (!empty($image_path)) {
			move_uploaded_file($_FILES["photo"]["tmp_name"], $image_path);
		} else {
			$image_path = '';
		}

		try {
			$stmt = $conn->prepare("INSERT INTO product_tbl (productClass_id, product_name, product_price, product_stock, product_code, product_picture) VALUES (:category, :name, :price, :stock, :code, :photo)");
			$stmt->execute(['category' => $category, 'name' => $name, 'price' => $price, 'stock' => $stock, 'code' => $code, 'photo' => $image_path]);
			$_SESSION['success'] = 'User added successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = $e->getMessage();
		}
	}

	$pdo->close();
} else {
	$_SESSION['error'] = 'Fill up product form first';
}

header('location: product.php');
