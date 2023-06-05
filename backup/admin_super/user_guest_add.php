<?php

    include 'includes/session.php';

    $conn = $pdo->open();

    if (isset($_POST['add']))
    {
        $customer_fname = $_POST['guest_fname'];
        $customer_lname = $_POST['guest_lname'];
        $customer_uname = $_POST['guest_uname'];
        $contact = $_POST['guest_contact'];
        $address_hn = $_POST['guest_address_hn'];
        $address_st = $_POST['guest_address_st'];
        $address_city = $_POST['guest_address_city'];

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

                $insert_stmt = $conn->prepare("INSERT INTO customer_tbl (customer_username, customer_firstname, customer_lastname, customerClass_id, customer_contactNo, customer_houseno, customer_street, customer_city) 
                                            VALUES (:cuname, :cfname, :clname, :ccategory, :ccontact, :caddresshn, :caddressst, :caddresscity)"); //sql insert query					

                if(
                    $insert_stmt->execute(
                        array(
                            ':cuname' => $customer_uname,
                            ':cfname' => $customer_fname,
                            ':clname' => $customer_lname,
                            ':ccategory' => 2,
                            ':ccontact' => $contact,
                            ':caddresshn' => $address_hn,
                            ':caddressst' => $address_st,
                            ':caddresscity' => $address_city,
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

    //Will be directed into user_guests.php
    header('location: user_guest.php');

?>