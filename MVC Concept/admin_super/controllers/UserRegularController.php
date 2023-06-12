<?php

    class UserRegularController
    {
        private $model;

        public function __construct($model) {
            $this->model = $model;
        }

        public function getUsers() {
            return $this->model->getUsers();
        }

        public function getUserById($id) {
            return $this->model->getUserById($id);
        }

        public function addUser($customer_fname, $customer_lname, $customer_uname, $contact, $address_hn, $address_st, $address_city, $password) {
            $this->model->addUser($customer_fname, $customer_lname, $customer_uname, $contact, $address_hn, $address_st, $address_city, $password);
        }

        public function updateUser($id, $customer_fname, $customer_lname, $customer_uname, $contact, $address_hn, $address_st, $address_city, $password) {
            $this->model->updateUser($id, $customer_fname, $customer_lname, $customer_uname, $contact, $address_hn, $address_st, $address_city, $password);
        }

        public function deleteUser($id) {
            $this->model->deleteUser($id);
        }
    }
    
?>
