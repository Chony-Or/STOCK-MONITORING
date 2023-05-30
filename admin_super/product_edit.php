<?php
include 'includes/session.php';

$pdo_conn = $pdo->open();

$target_dir = 'productsImages/';

if (isset($_POST['Submit'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $code = $_POST['product_code'];
    $price = $_POST['product_price'];
    $stock = $_POST['product_stock'];
    $category = $_POST['category'];

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];

        // Check if the uploaded image is valid
        if ($image_size < 5000000) {
            $image_path = basename($image_name);
            move_uploaded_file($image_tmp, $target_dir . $image_path);

            // Update the product details with the new image
            try {
                $stmt = $pdo_conn->prepare('UPDATE product_tbl SET productClass_id=:category, product_name=:name, product_price=:price, product_stock=:stock, product_code=:code, product_picture=:image WHERE product_id=:product_id');
                $stmt->execute(array(
                    ':category' => $category,
                    ':name' => $name,
                    ':price' => $price,
                    ':stock' => $stock,
                    ':code' => $code,
                    ':image' => $image_path,
                    ':product_id' => $product_id
                ));

                $successMsg = 'Product updated successfully';
            } catch (PDOException $e) {
                $errorMsg = 'Error: ' . $e->getMessage();
            }
        } else {
            $errorMsg = 'Image too large';
        }
    } else {
        // Update the product details without changing the image
        try {
            $stmt = $pdo_conn->prepare('UPDATE product_tbl SET productClass_id=:category, product_name=:name, product_price=:price, product_stock=:stock, product_code=:code WHERE product_id=:product_id');
            $stmt->execute(array(
                ':category' => $category,
                ':name' => $name,
                ':price' => $price,
                ':stock' => $stock,
                ':code' => $code,
                ':product_id' => $product_id
            ));

            $successMsg = 'Product updated successfully';
        } catch (PDOException $e) {
            $errorMsg = 'Error: ' . $e->getMessage();
        }
    }
}

$pdo_conn = null; // Close the database connection

// Redirect to product.php
header('location: product.php');
?>
