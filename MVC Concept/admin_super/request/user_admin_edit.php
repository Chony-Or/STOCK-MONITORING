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

        if (isset($_POST['edit']))
        {
            $id = $_GET['id'];
		    $username = $_POST['admin_uname'];
		    $password = $_POST['admin_pass'];

        
            try
            {
                $controller->editAdmin($id, $username, $password);
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

    header('location: ../user_admin.php');

?>