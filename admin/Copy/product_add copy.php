<?php
include 'includes/session.php';

if (isset($_POST['submit'])) {
	$name = $_POST['product'];
	$code = $_POST['code'];
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$category = $_POST['category'];

	$target_dir = "productImages/"; //for picture uploading

    // The path of the newly uploaded image
    $image_name = $_FILES['photo']['name'];
    $image_tmp = $_FILES['photo']['tmp_name'];
    $image_size = $_FILES['photo']['size'];

	$conn = $pdo->open();

    if(empty($name))
    {
        $errorMsg = 'Please input name';
    }
    elseif(empty($code))
    {
        $errorMsg = 'Please input code';
    }
    elseif(empty($price))
    {
        $errorMsg = 'Please input price';
    }
    elseif(empty($stock))
    {
        $errorMsg = 'Please input stock';
    }
    elseif(empty($category))
    {
        $errorMsg = 'Please input category';
    }
    else
    {
        // The path of the newly uploaded image
        $image_path = basename($image_name);

        if(!empty($image_tmp))
        {

            if($image_size < 5000000)
            {
                move_uploaded_file($image_tmp ,$target_dir.$image_path);
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

    if(!isset($errorMsg))
    {
        $stmt = "INSERT INTO product_tbl (productClass_id, product_name, product_price, product_stock, product_code, product_picture)
                VALUES ('".$name."', '".$code."', '".$price."', '".$category."', '".$image_path."')";
        $result = mysqli_query($conn, $stmt);

        if($result)
        {
            $successMsg = 'New record added successfully';
            header('Location: product.php');
        }
        else
        {
            $errorMsg = 'Error '.mysqli_error($conn);
        }
    }

}

?>