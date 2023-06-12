<?php

    class UserRegularModel
    {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function getUsers()
        {
            $stmt = $this->pdo->prepare("SELECT * FROM customer_tbl WHERE customerClass_id = 1");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getUserById($id)
        {
            $stmt = $this->pdo->prepare("SELECT * FROM customer_tbl WHERE customer_id = :id");
            $stmt->execute(['id' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addUser($customer_fname, $customer_lname, $customer_uname, $contact, $address_hn, $address_st, $address_city, $password)
        {
            $stmt = $this->pdo->prepare("INSERT INTO customer_tbl (customer_firstname, customer_lastname, customer_username, customerClass_id, customer_contactNo, customer_houseno, customer_street, customer_city, customer_password) 
                                        VALUES (:cfname, :clname, :cuname, :ccategory, :ccontact, :caddresshn, :caddressst, :caddresscity, :cpassword)");
            $stmt->execute([
                'cfname' => $customer_fname,
                'clname' => $customer_lname,
                'cuname' => $customer_uname,
                ':ccategory' => 1,
                'ccontact' => $contact,
                'caddresshn' => $address_hn,
                'caddressst' => $address_st,
                'caddresscity' => $address_city,
                'cpassword' => $password
            ]);
        }

        public function updateUser($id, $customer_fname, $customer_lname, $customer_uname, $contact, $address_hn, $address_st, $address_city, $password)
        {
            $stmt = $this->pdo->prepare("UPDATE customer_tbl SET customer_firstname = :cfname, customer_lastname = :clname, customer_username = :cuname, customer_contactNo = :ccontact, customer_houseno = :caddresshn, customer_street = :caddressst, customer_city = :caddresscity, customer_password = :cpassword WHERE customer_id = :id");
            $stmt->execute([
                'cfname' => $customer_fname,
                'clname' => $customer_lname,
                'cuname' => $customer_uname,
                'ccontact' => $contact,
                'caddresshn' => $address_hn,
                'caddressst' => $address_st,
                'caddresscity' => $address_city,
                'cpassword' => $password,
                'id' => $id
            ]);
        }

        public function deleteUser($id)
        {
            $stmt = $this->pdo->prepare("DELETE FROM customer_tbl WHERE customer_id = :id");
            $stmt->execute(['id' => $id]);
        }
    }
    
?>
