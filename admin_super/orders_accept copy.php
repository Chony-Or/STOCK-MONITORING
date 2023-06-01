<?php

include 'includes/session.php';

// Call the acceptAllOrders function and return the response as JSON
$response = acceptAllOrders();

header('Content-Type: application/json');
echo json_encode($response);

// Function to accept all orders
function acceptAllOrders()
{
    global $pdo;

    try
    {
        $conn = $pdo->open();

        // Start a transaction to ensure data consistency
        $conn->beginTransaction();

        // Move orders from pendingorder_tbl to on_processorder_tbl
        $moveQuery = 'INSERT INTO on_processorder_tbl (pendingOrder_id, customer_id, product_id, quantity, amount)
                    SELECT po.pendingOrder_id, po.customer_id, po.product_id, po.quantity, po.amount
                    FROM pendingorder_tbl po
                    INNER JOIN customer_tbl c ON po.customer_id = c.customer_id';

        $conn->exec($moveQuery);

        // Update product stock quantities, which means lessen the order quantity from the product stock
        $updateQuery = 'UPDATE product_tbl p
                        JOIN pendingorder_tbl po ON p.product_id = po.product_id
                        SET p.product_stock = p.product_stock - po.quantity';

        $conn->exec($updateQuery);

        // Delete orders from pendingorder_tbl
        $deleteQuery = 'DELETE FROM pendingorder_tbl';
        $conn->exec($deleteQuery);

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
