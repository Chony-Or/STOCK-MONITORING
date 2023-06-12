<?php

    // Include necessary files
    include_once('models/UserRegularModel.php');
    include_once('controllers/UserRegularController.php');

    // Create objects
    try
    {
        $pdo = new PDO("mysql:host=localhost;dbname=full;charset=utf8mb4", "root", "");

        $model = new UserRegularModel($pdo);
        $controller = new UserRegularController($model);

        // Handle delete action
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']))
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
    }
    catch (PDOException $e)
    {
        die("Database connection failed: " . $e->getMessage());
    }

    // Get all users
    $users = $controller->getUsers();

    // Include the main view file
    include('views/user_regular_view.php');
    
?>