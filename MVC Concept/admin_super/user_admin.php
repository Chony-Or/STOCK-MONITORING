<?php

    include_once('models/UserAdminModel.php');
    include_once('controllers/UserAdminController.php');

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    $pdo = new PDO('mysql:host=localhost;dbname=full', 'root', '');
    $model = new AdminModel($pdo);
    $controller = new AdminController($model);

    if ($action === 'edit' && isset($_POST['edit']))
    {
        $id = $_GET['id'];
        $username = $_POST['admin_uname'];
        $password = $_POST['admin_pass'];
        $controller->editAdmin($id, $username, $password);

        header('location: views/user_admin_view.php');
        exit;
    }

    if ($action === 'delete' && isset($_GET['id']))
    {
        $id = $_GET['id'];
        $controller->deleteAdmin($id);
        header('location: views/user_admin_view.php');

        exit;
    }

    if ($action === 'add' && isset($_POST['add']))
    {
        $username = $_POST['txt_username'];
        $password = $_POST['txt_password'];
        $controller->addAdmin($username, $password);
        header('location: views/user_admin_view.php');

        exit;
    }

    // Get all users
    $users = $controller->getAdmin();

    // Include the main view file
    include('views/user_admin_view.php');

?>