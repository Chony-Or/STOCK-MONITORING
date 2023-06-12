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

        if (isset($_POST['edit']))
        {
            $id = $_GET['id'];
            $customer_fname = $_POST['rFName'];
            $customer_lname = $_POST['rLName'];
            $customer_uname = $_POST['rUName'];
            $contact = $_POST['rContact'];
            $address_hn = $_POST['rAddressHn'];
            $address_st = $_POST['rAddressSt'];
            $address_city = $_POST['rAddressCity'];
            $password = $_POST['rPassword'];
        
            try
            {
                $controller->updateUser($id, $customer_fname, $customer_lname, $customer_uname, $contact, $address_hn, $address_st, $address_city, $password);
                $_SESSION['success'] = 'User updated successfully';
            }
            catch (Exception $e)
            {
                $_SESSION['error'] = $e->getMessage();
            }
        } 
        else
        {
            $_SESSION['error'] = 'Fill up edit user form first';
        }
    }
    catch (PDOException $e)
    {
        die("Database connection failed: " . $e->getMessage());
    }

    header('location: ../user_regular.php');
    
?>