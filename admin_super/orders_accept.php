<?php

    include 'includes/session.php';

    // Call the acceptAllOrders function and return the response as JSON
    $response = acceptAllOrders($_GET['order_number']);

    header('Content-Type: application/json');
    echo json_encode($response);

    // Function to accept all orders
    function acceptAllOrders($orderNumber)
    {
        global $pdo;

        try
        {
            $conn = $pdo->open();

            // Start a transaction to ensure data consistency
            $conn->beginTransaction();

            // Move shown orders from pendingorder_tbl to on_processorder_tbl
            $moveQuery = 'INSERT INTO on_processorder_tbl (pendingOrder_id, customer_id, product_id, quantity, amount)
                        SELECT po.pendingOrder_id, po.customer_id, po.product_id, po.quantity, po.amount
                        FROM pendingorder_tbl po
                        INNER JOIN customer_tbl c ON po.customer_id = c.customer_id
                        WHERE po.order_number = :orderNumber';

            $stmt = $conn->prepare($moveQuery);
            $stmt->execute(['orderNumber' => $orderNumber]);

            // Update product stock quantities for the shown orders
            $updateQuery = 'UPDATE product_tbl p
                            JOIN pendingorder_tbl po ON p.product_id = po.product_id
                            SET p.product_stock = p.product_stock - po.quantity
                            WHERE po.order_number = :orderNumber';

            $stmt = $conn->prepare($updateQuery);
            $stmt->execute(['orderNumber' => $orderNumber]);

            // Copy accepted order data to notification_tbl
            $copyQuery = 'INSERT INTO notification_tbl (pendingOrder_id, customer_id, product_id, notif_subject, notif_context)
                        SELECT po.pendingOrder_id, po.customer_id, po.product_id, CONCAT(p.product_name, " - ", po.order_number) as notif_subject, "In Process"
                        FROM pendingorder_tbl po
                        INNER JOIN product_tbl p ON po.product_id = p.product_id
                        WHERE po.order_number = :orderNumber';

            $stmt = $conn->prepare($copyQuery);
            $stmt->execute(['orderNumber' => $orderNumber]);


            // Delete shown orders from pendingorder_tbl
            $deleteQuery = 'DELETE FROM pendingorder_tbl WHERE order_number = :orderNumber';
            $stmt = $conn->prepare($deleteQuery);
            $stmt->execute(['orderNumber' => $orderNumber]);

            // Commit the transaction
            $conn->commit();
            $pdo->close();

            // Return success message
            return ['success' => true, 'message' => 'All orders have been accepted'];
        }
        catch (PDOException $e)
        {
            // Rollback the transaction on error
            $conn->rollBack();

            // Return error message with the specific error details
            return ['success' => false, 'message' => 'Failed to accept orders: ' . $e->getMessage()];
        }
    }

?>
