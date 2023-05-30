<?php

    include 'includes/session.php';

    // Check if the order ID is provided
    if (isset($_GET['pendingOrder_id']))
    {
    $pendingOrderId = $_GET['pendingOrder_id'];

    // Implement the logic to remove the order from the database
    // Here's an example using PDO:

    try {
        // Prepare and execute the query to remove the order
        $conn = $pdo->open();
        $stmt = $conn->prepare('DELETE FROM pendingorder_tbl WHERE pendingOrder_id = :pendingOrderId');
        $stmt->execute(['pendingOrderId' => $pendingOrderId]);

        // Check if the order was successfully removed
        if ($stmt->rowCount()) {
            // Order removed successfully
            echo json_encode(['success' => true]);
        } else {
            // Failed to remove the order
            echo json_encode(['success' => false, 'message' => 'Failed to remove the order']);
        }
    } catch (PDOException $e) {
        // Database error occurred
        echo json_encode(['success' => false, 'message' => 'Database error occurred']);
    }

    $pdo->close();
} else {
    // Order ID not provided
    echo json_encode(['success' => false, 'message' => 'Order ID not provided']);
}
