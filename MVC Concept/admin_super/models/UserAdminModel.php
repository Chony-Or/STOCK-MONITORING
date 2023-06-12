<?php

    class AdminModel
    {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function getAdmin()
        {
            $stmt = $this->pdo->prepare("SELECT * FROM admin_tbl");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAdminById($id)
        {
            $stmt = $this->pdo->prepare("SELECT * FROM admin_tbl WHERE admin_id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        }

        public function addAdmin($username, $password)
        {
            $stmt = $this->pdo->prepare("INSERT INTO admin_tbl (admin_username, admin_password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
        }

        public function updateAdmin($id, $username, $password)
        {
            $row = $this->getAdminById($id);

            if ($password == $row['admin_password'])
            {
                $password = $row['admin_password'];
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }

            $stmt = $this->pdo->prepare("UPDATE admin_tbl SET admin_username = :username, admin_password = :password WHERE admin_id = :id");
            $stmt->execute(['username' => $username, 'password' => $password, 'id' => $id]);
        }

        public function deleteAdmin($id)
        {
            $stmt = $this->pdo->prepare("DELETE FROM admin_tbl WHERE admin_id = :id");
            $stmt->execute(['id' => $id]);
        }
    }
    
?>

