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

        // Update the order status in the on_processorder_tbl table
        $updateQuery = 'UPDATE on_processorder_tbl SET status = :status WHERE activeOrder_id = :orderID';
        $stmt = $conn->prepare($updateQuery);
        $stmt->execute(['status' => $status, 'orderID' => $orderID]);

        $pdo->close();

        // Return success message
        return ['success' => true, 'message' => 'Order status updated successfully'];
    } catch (PDOException $e) {
        // Return error message with the specific error details
        return ['success' => false, 'message' => 'Failed to update order status: ' . $e->getMessage()];
    }
}
