<?php

    include 'includes/session.php';

    $conn = $pdo->open();

    if (isset($_POST['add']))
    {
        $customer_fname = $_POST['regular_fname'];
        $customer_lname = $_POST['regular_lname'];
        $customer_uname = $_POST['regular_uname'];
        $contact = $_POST['regular_contact'];
        $address_hn = $_POST['regular_address_hn'];
        $address_st = $_POST['regular_address_st'];
        $address_city = $_POST['regular_address_city'];
        $password = $_POST['regular_password'];

        try
        {
            $stmt = $conn->prepare("SELECT customer_username FROM customer_tbl WHERE customer_username=:cuname");
            $stmt->execute(array(':cuname' => $customer_uname));
            $row = $stmt->fetch();

            if ($row["customer_username"] == $customer_uname)
            {
                $_SESSION['message'] = 'Sorry username already exists';
            }
        
            else if (!isset($errorMsg)) //check no "$errorMsg" show then continue
            {
                $new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()

                $insert_stmt = $conn->prepare("INSERT INTO customer_tbl (customer_username, customer_firstname, customer_lastname, customerClass_id, customer_contactNo, customer_houseno, customer_street, customer_city, customer_password) 
                                            VALUES (:cuname, :cfname, :clname, :ccategory, :ccontact, :caddresshn, :caddressst, :caddresscity, :cpassword)"); //sql insert query					

                if(
                    $insert_stmt->execute(
                        array(
                            ':cuname' => $customer_uname,
                            ':cfname' => $customer_fname,
                            ':clname' => $customer_lname,
                            ':ccategory' => 1,
                            ':ccontact' => $contact,
                            ':caddresshn' => $address_hn,
                            ':caddressst' => $address_st,
                            ':caddresscity' => $address_city,
                            ':cpassword' => $new_password
                        )
                    )
                )
                {
                    $_SESSION['message'] = "Register Successfully..... Please Click On Login Account Link"; //execute query success message
                }
            }
        }
    
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    $pdo->close();

    //Will be directed into user_regulars.php
    header('location: user_regular.php');

?>