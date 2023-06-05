<?php

    include 'includes/connection.php';

    session_start();

    if (isset($_SESSION["admin_login"])) //Check condition user login not direct back to index.php page
    {
        if ($_SESSION["admin_type"] == "super")
        {
            header("location: admin_super/index.php"); //Direct to admin_super folder and index.php (Super Admin which has an access to all functions)
        }
        else if ($_SESSION["admin_type"] == "admin")
        {
            header("location: admin/index.php"); //Direct to admin folder and index.php (Admin which has a limited access to some functions)
        }
    }

?>
