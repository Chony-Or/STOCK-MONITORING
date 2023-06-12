<?php
include '../models/Database.php';

class SessionController
{
    public function __construct()
    {
        include '../models/Database.php';
        session_start();

        if (isset($_SESSION["admin_login"])) {
            if ($_SESSION["admin_type"] == "super") {
                header("location: ../admin_super/index.php");
            } else if ($_SESSION["admin_type"] == "admin") {
                header("location: ../admin/index.php");
            }
        }
    }
}

$sessionController = new SessionController();
