<?php

    include '../models/Database.php';

    class UserController
    {
        private $conn;

        public function __construct(){
            $this->conn = (new Database())->open();
        }

        public function verifyLogin($username, $password)
        {
            try
            {
                $stmt = $this->conn->prepare("SELECT *, COUNT(*) AS numrows FROM admin_tbl WHERE admin_username=:uname");
                $stmt->execute([':uname' => $username]);
                $row = $stmt->fetch();

                if ($row['numrows'] > 0)
                {
                    if ($username == $row["admin_username"])
                    {
                        if (password_verify($password, $row['admin_password']))
                        {
                            $_SESSION["admin_login"] = $row["admin_id"];
                            $_SESSION["admin_type"] = $row["admin_type"];

                            if ($row["admin_type"] == "super")
                            {
                                header("location: ../admin_super/index.php");
                            }
                            else if ($row["admin_type"] == "admin")
                            {
                                header("location: ../admin/index.php");
                            }
                        }
                        else
                        {
                            $_SESSION['error'] = 'Incorrect Password';
                        }
                    }
                    else
                    {
                        $_SESSION['error'] = 'Account not activated.';
                    }
                }
                else
                {
                    $_SESSION['error'] = 'Username not found';
                }
            }
            catch (PDOException $e)
            {
                echo "There is some problem in connection: " . $e->getMessage();
            }

            $this->conn = null;

            header('location: ../views/login.php');
            exit();
        }
    }

    $userController = new UserController();

?>
