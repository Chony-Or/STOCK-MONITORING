<?php
include 'includes/session.php';

// Connect to database
$con = mysqli_connect("localhost", "root", "", "la_bvrgs");

// The following code checks if the submit button is clicked
// and inserts the data in the database accordingly
if (isset($_POST['submit'])) {
    // Store the Product name in a "name" variable
    $name = mysqli_real_escape_string($con, $_POST['product']);

    // Store the Category ID in a "id" variable
    $id = mysqli_real_escape_string($con, $_POST['category']);

    // Creating an insert query using SQL syntax and
    // storing it in a variable.
    $sql_insert =
        "INSERT INTO `product_tbl`(`product_name`, `productClass_id`)
			VALUES ('$name','$id')";

    // The following code attempts to execute the SQL query
    // if the query executes with no errors
    // a javascript alert message is displayed
    // which says the data is inserted successfully
    if (mysqli_query($con, $sql_insert)) {
        echo '<script>alert("Product added successfully")</script>';
    }
}

header('location: admin.php');
?>



<?php
include 'includes/session.php';

$conn = $pdo->open();

if (isset($_POST['submit'])) {


            // Insert image info into the database (title, description, image path, and date added)
            $stmt = $conn->prepare('INSERT INTO product_tbl (product_name, productClass_id) VALUES (?, ?)');
            $stmt->execute([$_POST['product'], $_POST['category'],]);
            $msg = 'Product Added Successfully!';
}

header('location: product.php');
?>





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
?>






<?php
	include 'includes/session.php';

	if(isset($_POST['submit'])){
		$name = $_POST['product'];
        $filename = $_FILES['photo']['product'];
        $code = $_POST['code'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
		$category = $_POST['category'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM product_tbl WHERE product_name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Product already exist';
		}
		else{
			if(!empty($filename)){
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$new_filename = $name.'.'.$ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);	
			}
			else{
				$new_filename = '';
			}

			try{
				$stmt = $conn->prepare("INSERT INTO product_tbl (productClass_id, product_name, product_price, product_stock, product_code, product_picture) VALUES (:category, :name, :price, :stock, :code, :photo)");
				$stmt->execute(['category'=>$category, 'name'=>$name, 'price'=>$price, 'stock'=>$stock, 'code'=>$code, 'photo'=>$new_filename]);
				$_SESSION['success'] = 'User added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up product form first';
	}

	header('location: product.php');

?>
