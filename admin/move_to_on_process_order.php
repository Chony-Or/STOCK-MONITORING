<?php
// move_to_on_process_order.php

// Assuming you have a database connection established

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['orderNumber'])) {
        $orderNumber = $_POST['orderNumber'];

        // Retrieve the order details from the order_status_tbl
        // You need to modify this code according to your database structure and select query

        // Example code using PDO
        $stmt = $pdo->prepare('SELECT * FROM order_status_tbl WHERE order_number = :orderNumber');
        $stmt->execute([
            'orderNumber' => $orderNumber
        ]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            // Insert the order into the on_process_order_tbl
            // You need to modify this code according to your database structure and insert query

            // Example code using PDO
            $stmt = $pdo->prepare('INSERT INTO on_process_order_tbl (customer_name, order_id, quantity, amount) VALUES (:customerName, :orderId, :quantity, :amount)');
            $stmt->execute([
                'customerName' => $order['customer_name'],
                'orderId' => $order['order_id'],
                'quantity' => $order['quantity'],
                'amount' => $order['amount']
            ]);

            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
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
            } else {
                // Return a failure response
                echo 'failure';
            }
        } else {
            // Return a failure response if the order doesn't exist
            echo 'failure';
        }
    }
}
?>

