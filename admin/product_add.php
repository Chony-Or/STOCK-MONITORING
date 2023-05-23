<?php

include 'includes/session.php';

$pdo_conn = $pdo->open();

$target_dir = 'productsImages/';

if (isset($_POST['Submit'])) {
    // Declare the variable that will hold the pass value
	$name = $_POST['name'];
	$code = $_POST['code'];
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$category = $_POST['category'];

    // The path of the newly uploaded image
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];

    if (empty($name)) {
        $errorMsg = 'Please input name';
    } elseif (empty($name)) {
        $errorMsg = 'Please input contact';
    } elseif (empty($code)) {
        $errorMsg = 'Please input email';
    } else {
        // The path of the newly uploaded image
        $image_path = basename($image_name);

        if (!empty($image_tmp)) {
            if ($image_size < 5000000) {
                move_uploaded_file($image_tmp, $target_dir . $image_path);
            } else {
                $errorMsg = 'Image too large';
            }
        } else {
            $errorMsg = 'Please select a valid image';
        }
    }

	if (!isset($errorMsg)) {
        try {
            $stmt = $pdo_conn->prepare('INSERT INTO product_tbl (productClass_id, product_name, product_price, product_stock, product_code, product_picture)
			VALUES (:category, :name, :price, :stock, :code, :image)');

			$stmt->execute(array(
				':category' => $category,
				':name' => $name,
				':price' => $price,
				':stock' => $stock,
				':code' => $code,
				':image' => $image_path
			));

            $successMsg = 'New record added successfully';
        } catch (PDOException $e) {
            $errorMsg = 'Error: ' . $e->getMessage();
        }
    }
}

$pdo_conn = null; // Close the database connection

// Will be directed to product.php
header('location: product.php');
