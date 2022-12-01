<?php

include 'includes/session.php';

// The output message
$msg = '';
// Check if user has uploaded new image
if (isset($_FILES['image'], $_POST['product_name'], $_POST['product_stock'])) {
    // The folder where the images will be stored
    $target_dir = 'images/';
    // The path of the new uploaded image
    $image_path = $target_dir . basename($_FILES['image']['name']);
    // Check to make sure the image is valid
    if (!empty($_FILES['image']['tmp_name']) && getimagesize($_FILES['image']['tmp_name'])) {
        if (file_exists($image_path)) {
            $msg = 'Image already exists, please choose another or rename that image.';
        } else if ($_FILES['image']['size'] > 500000) {
            $msg = 'Image file size too large, please choose an image less than 500kb.';
        } else {
            // Everything checks out now we can move the uploaded image
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
            // Connect to MySQL

            $conn = $pdo->open();
            // Insert image info into the database (title, description, image path, and date added)
            $stmt = $conn->prepare('INSERT INTO product_tbl (product_name, product_stock, product_picture, product_price, product_code, date_created) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)');
            $stmt->execute([$_POST['product_name'], $_POST['product_stock'], $image_path, $_POST['product_price'], $_POST['product_code'],]);
            $msg = 'Product Added Successfully!';
        }
    } else {
        $msg = 'Please upload an image!';
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/image.css">

<section class="home-section">

    <div class="text"> Add New File </div>

    <div class="content upload">

        <form action="index.php?page=inventory/upload" method="post" enctype="multipart/form-data">
            <label for="image">Choose Image</label>
            <input type="file" name="image" accept="image/*" id="image">
            <label for="title">Name</label>
            <input type="text" name="product_name" id="title">
            <label for="description">Stock</label>
            <input name="product_stock" id="description"></input>

            <label for="price">Price</label>
            <input type="text" name="product_price" id="price">

            <label for="code">Product Code</label>
            <input type="text" name="product_code" id="code">

            <input type="submit" value="Upload Image" name="submit">
        </form>
        <p>
            <?= $msg ?>
        </p>
    </div>

    <div class="container-fluid" style="background-color: white;">

    </div>

</section>