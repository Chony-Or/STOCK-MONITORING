<?php

    include 'includes/session.php';

    // Retrieve the order ID and status from the URL parameters
    $orderID = $_GET['activeOrder_id'];
    $status = $_GET['status'];

    // Call the updateOrderStatus function and return the response as JSON
    $response = updateOrderStatus($orderID, $status);
    header('Content-Type: application/json');
    echo json_encode($response);

    // Function to update the order status
    function updateOrderStatus($orderID, $status)
    {
        global $pdo;

        try {
            $conn = $pdo->open();

            // Check if the status is "Received"
            if ($status == 'received')
            {
                // Retrieve the order details from the on_processorder_tbl
                $selectQuery = 'SELECT * FROM on_processorder_tbl WHERE activeOrder_id = :orderID';
                $stmt = $conn->prepare($selectQuery);
                $stmt->execute(['orderID' => $orderID]);
                $order = $stmt->fetch();

                // Insert the order details into the transachistory_tbl with status as "Received"
                $insertQuery = 'INSERT INTO transachistory_tbl (activeOrder_id, product_id, customer_id, quantity, amount, date_created, status)
                                VALUES (:activeOrder_id, :product_id, :customer_id, :quantity, :amount, :date_created, :status)';
                $stmt = $conn->prepare($insertQuery);
                $stmt->execute([
                    'activeOrder_id' => $order['activeOrder_id'],
                    'product_id' => $order['product_id'],
                    'customer_id' => $order['customer_id'],
                    'quantity' => $order['quantity'],
                    'amount' => $order['amount'],
                    'date_created' => $order['date_created'],
                    'status' => 'Received'
                ]);

                // Remove the order from the on_processorder_tbl
                $deleteQuery = 'DELETE FROM on_processorder_tbl WHERE activeOrder_id = :orderID';
                $stmt = $conn->prepare($deleteQuery);
                $stmt->execute(['orderID' => $orderID]);
            }

            // Check if the status is "Cancelles"
            elseif ($status == 'cancelled')
            {
                // Retrieve the order details from the on_processorder_tbl
                $selectQuery = 'SELECT * FROM on_processorder_tbl WHERE activeOrder_id = :orderID';
                $stmt = $conn->prepare($selectQuery);
                $stmt->execute(['orderID' => $orderID]);
                $order = $stmt->fetch();

                // Insert the order details into the transachistory_tbl with status as "Cancelled"
                $insertQuery = 'INSERT INTO transachistory_tbl (activeOrder_id, product_id, customer_id, quantity, amount, date_created, status)
                                VALUES (:activeOrder_id, :product_id, :customer_id, :quantity, :amount, :date_created, :status)';
                $stmt = $conn->prepare($insertQuery);
                $stmt->execute([
                    'activeOrder_id' => $order['activeOrder_id'],
                    'product_id' => $order['product_id'],
                    'customer_id' => $order['customer_id'],
                    'quantity' => $order['quantity'],
                    'amount' => $order['amount'],
                    'date_created' => $order['date_created'],
                    'status' => 'Cancelled'
                ]);

                // Remove the order from the on_processorder_tbl
                $deleteQuery = 'DELETE FROM on_processorder_tbl WHERE activeOrder_id = :orderID';
                $stmt = $conn->prepare($deleteQuery);
                $stmt->execute(['orderID' => $orderID]);
            }

            // Check if the status is "Delivery"
            elseif ($status == 'delivery')
            {
                // Handle "Out for Delivery" status
                // Update the order status in the on_processorder_tbl
                $updateQuery = 'UPDATE on_processorder_tbl SET status = :status WHERE activeOrder_id = :orderID';
                $stmt = $conn->prepare($updateQuery);
                $stmt->execute(['status' => 'Out for Delivery', 'orderID' => $orderID]);
            }

            // Check if the status is "In Process"
            elseif ($status == 'ongoing')
            {
                // Update the order status in the on_processorder_tbl
                $updateQuery = 'UPDATE on_processorder_tbl SET status = :status WHERE activeOrder_id = :orderID';
                $stmt = $conn->prepare($updateQuery);
                $stmt->execute(['status' => 'In Process', 'orderID' => $orderID]);
            }
            else
            {
                // Update the order status in the on_processorder_tbl
                $updateQuery = 'UPDATE on_processorder_tbl SET status = :status WHERE activeOrder_id = :orderID';
                $stmt = $conn->prepare($updateQuery);
                $stmt->execute(['status' => $status, 'orderID' => $orderID]);
            }

            $pdo->close();

            // Return success message
            return ['success' => true, 'message' => 'Order status updated successfully'];
        }
        catch (PDOException $e)
        {
            // Return error message with the specific error details
            return ['success' => false, 'message' => 'Failed to update order status: ' . $e->getMessage()];
        }
    }
    
?>
