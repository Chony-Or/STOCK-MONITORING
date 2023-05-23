<?php
// remove_from_order_status.php

// Assuming you have a database connection established

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['orderNumber'])) {
        $orderNumber = $_POST['orderNumber'];

        // Remove the order from the order_status_tbl
        // You need to modify this code according to your database structure and delete query

        // Example code using PDO
        $stmt = $pdo->prepare('DELETE FROM order_status_tbl WHERE order_number = :orderNumber');
        $stmt->execute([
            'orderNumber' => $orderNumber
        ]);

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            // Return a success response
            echo 'success';
        } else {
            // Return a failure response
            echo 'failure';
        }
    }
}
?>
