<?php
include 'includes/session.php';

$conn = $pdo->open();

if (isset($_POST['add'])) {
    $customer = $_POST['regular_name'];
    $address = $_POST['regular_address'];
    $contact = $_POST['regular_contact'];
    $password = $_POST['regular_password'];

    try {
        $stmt = $conn->prepare("SELECT customer_name FROM customer_tbl WHERE customer_name=:cname");
        $stmt->execute(array(':cname' => $customer));
        $row = $stmt->fetch();

        if ($row["customer_name"] == $customer) {
            $_SESSION['message'] = 'Sorry username already exists';
        } else if (!isset($errorMsg)) //check no "$errorMsg" show then continue
        {
            $new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()

            $insert_stmt = $conn->prepare("INSERT INTO customer_tbl (customer_name, customerClass_id, customer_address, customer_contactNo, customer_password) VALUES (:cname, :ccategory, :caddress, :ccontact, :cpassword)"); //sql insert query					

            if (
                $insert_stmt->execute(
                    array(
                        ':cname' => $customer,
                        ':ccategory' => 1,
                        ':caddress' => $address,
                        ':ccontact' => $contact,
                        ':cpassword' => $new_password
                    )
                )
            ) {

                $_SESSION['message'] = "Register Successfully..... Please Click On Login Account Link"; //execute query success message
            }
        }



    } catch (PDOException $e) {
        echo $e->getMessage();
    }

} 
$pdo->close();

header('location: user_guest.php');
?>