<?php

    // Include necessary files
    include_once('../models/UserAdminModel.php');
    include_once('../controllers/UserAdminController.php');

    // Create objects
    try
    {
        $pdo = new PDO("mysql:host=localhost;dbname=full;charset=utf8mb4", "root", "");

        $model = new AdminModel($pdo);
        $controller = new AdminController($model);

        if (isset($_POST['add']))
        {
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];
        
            try
            {
                $controller->addAdmin($username, $password);
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

    header('location: ../user_admin.php');
    
?>