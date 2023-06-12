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

        if (isset($_GET['id']))
        {
            try
            {
                $controller->deleteAdmin($_GET['id']);
                $_SESSION['message'] = 'User deleted successfully';
            }
            catch (Exception $e)
            {
                $_SESSION['message'] = $e->getMessage();
            }
        }
        else
        {
            $_SESSION['message'] = 'Select member to delete first';
        }
    }
    catch (PDOException $e)
    {
        die("Database connection failed: " . $e->getMessage());
    }

    header('location: ../user_admin.php');
    
?>
