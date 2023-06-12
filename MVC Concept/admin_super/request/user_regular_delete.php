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

        if (isset($_GET['id']))
        {
            try
            {
                $controller->deleteUser($_GET['id']);
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

    header('location: ../user_regular.php');
    
?>
