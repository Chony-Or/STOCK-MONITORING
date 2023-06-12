<?php

    // Include necessary files
    include_once('../models/UserRegularModel.php');
    include_once('../controllers/UserRegularController.php');

    // Create objects
    try
    {
        $pdo = new PDO("mysql:host=localhost;dbname=full;charset=utf8mb4", "root", "");

        $model = new UserRegularModel($pdo);
        $controller = new UserRegularController($model);

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

    header('location: ../user_regular.php');
    
?>