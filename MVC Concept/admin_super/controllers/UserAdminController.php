<?php

    class AdminController
    {
        private $model;

        public function __construct($model) {
            $this->model = $model;
        }

        public function getAdmin() {
            return $this->model->getAdmin();
        }

        public function addAdmin($username, $password) {
            $this->model->addAdmin($username, $password);
            $_SESSION['message'] = 'Register Successfully..... Please Click On Login Account Link';
        }
    
        public function editAdmin($id, $username, $password) {
            $this->model->updateAdmin($id, $username, $password);
            $_SESSION['success'] = 'User updated successfully';
        }

        public function deleteAdmin($id) {
            $this->model->deleteAdmin($id);
            $_SESSION['message'] = 'Member deleted successfully';
        }
    }
    
?>

