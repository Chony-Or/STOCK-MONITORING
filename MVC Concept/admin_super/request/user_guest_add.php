<?php

    // Include necessary files
    include_once('../models/UserGuestModel.php');
    include_once('../controllers/UserGuestController.php');

    // Create objects
    try
    {
        $pdo = new PDO("mysql:host=localhost;dbname=full;charset=utf8mb4", "root", "");

        $model = new UserGuestModel($pdo);
        $controller = new UserGuestController($model);

        if (isset($_POST['add']))
        {
            $customer_fname = $_POST['guest_fname'];
            $customer_lname = $_POST['guest_lname'];
            $customer_uname = $_POST['guest_uname'];
            $contact = $_POST['guest_contact'];
            $address_hn = $_POST['guest_address_hn'];
            $address_st = $_POST['guest_address_st'];
            $address_city = $_POST['guest_address_city'];
            $password = $_POST['guest_password'];
        
            try
            {
                $controller->addUser($customer_fname, $customer_lname, $customer_uname, $contact, $address_hn, $address_st, $address_city, $password);
                $_SESSION['message'] = 'Register Successfully..... Please Click On Login Account Link';
            }
            catch (Exception $e)
            {
                $_SESSION['message'] = $e->getMessage();
            }
        }
    }
    catch (PDOException $e)
    {
        die("Database connection failed: " . $e->getMessage());
    }

    header('location: ../user_guest.php');
    
?>