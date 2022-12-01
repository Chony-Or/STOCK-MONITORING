<?php

include 'includes/session.php';

if (isset($_POST['add_regular'])) //button name "btn_register"
{
    $name = ($_POST['txt_user_name']); //textbox name "txt_email"
    $address = ($_POST['txt_address']); //textbox name "txt_address"
    $contact = ($_POST['txt_number']); //textbox name "txt_contact"
    $password = ($_POST['txt_user_password']); //textbox name "txt_user_password"

    try {
        $stmt = $conn->prepare("SELECT customer_name, customer_address, customer_contactNo FROM customer_tbl WHERE customer_name=:uname OR customer_address=:uaddress OR customer_contactNo=:ucontact"); // sql select query

        $stmt->execute(array(':uname' => $name, ':uaddress' => $address, ':ucontact' => $contact, )); //execute query 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row["customer_name"] == $name) {
            $_SESSION['message'] = 'Sorry username already exists'; //check condition username already exists 
        } else if (!isset($errorMsg)) //check no "$errorMsg" show then continue
        {
            $new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()

            $insert_stmt = $conn->prepare("INSERT INTO customer_tbl	(customer_name,customer_address,customer_contactNo, customer_password) VALUES
																(:uname,:uaddress, :ucontact, :upassword)"); //sql insert query					

            if (
                $insert_stmt->execute(
                    array(
                        ':uname' => $name,
                        ':uaddress' => $address,
                        ':ucontact' => $contact,
                        ':upassword' => $new_password
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

?>