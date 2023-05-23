<?php
// decline_order.php

// Assuming you have a database connection established

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['orderNumber'])) {
        $orderNumber = $_POST['orderNumber'];

        // Update the order status in the database to indicate decline
        // You need to modify this code according to your database structure and update query

        // Example code using PDO
        $stmt = $pdo->prepare('UPDATE order_status_table SET status = :status WHERE order_number = :orderNumber');
        $stmt->execute([
            'status' => 'Declined',
            'orderNumber' => $orderNumber
        ]);

        // Check if the update was successful
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
