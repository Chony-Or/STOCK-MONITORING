<?php
include 'includes/session.php';

$target_dir = "productsImages/"; //for picture uploading

if (isset($_POST['submit'])) {
	$name = $_POST['product'];
	$code = $_POST['code'];
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$category = $_POST['category'];

	// The path of the newly uploaded image
	$image_name = $_FILES['image']['name'];
	$image_tmp = $_FILES['image']['tmp_name'];
	$image_size = $_FILES['image']['size'];
	
	$conn = $pdo->open();

	if(empty($name))
	{
		$errorMsg = 'Please input name';
	}
	elseif(empty($code))
	{
		$errorMsg = 'Please input contact';
	}
	elseif(empty($price))
	{
		$errorMsg = 'Please input email';
	}
	elseif(empty($stock))
	{
		$errorMsg = 'Please input email';
	}
	elseif(empty($category))
	{
		$errorMsg = 'Please input email';
	}
	else
	{
		// The path of the newly uploaded image
		$image_path = basename($image_name);

		if (!empty($image_tmp))
		{
            if ($image_size < 5000000)
			{
                move_uploaded_file($image_tmp, $target_dir . $image_path);
            } 
			else 
			{
                $errorMsg = 'Image too large';
            }
        } 
		else 
		{
            $errorMsg = 'Please select a valid image';
        }
	}

	if (!isset($errorMsg)) {
        try {
            $conn = new PDO("mysql:host=your_host;dbname=your_database", "username", "password");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO product_tbl (productClass_id, product_name, product_price, product_stock, product_code, product_picture) VALUES (:category, :name, :price, :stock, :code, :image)";
            $stmt = $conn->prepare($sql);
			$stmt->bindParam(':category', $category);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':stock', $stock);
			$stmt->bindParam(':code', $code);
            $stmt->bindParam(':image', $image_path);
            $stmt->execute();

            $successMsg = 'New record added successfully';
            header('Location: product.php');
            exit();
        } 
		catch (PDOException $e) 
		{
            $errorMsg = 'Error: ' . $e->getMessage();
        }
    }
}

?>