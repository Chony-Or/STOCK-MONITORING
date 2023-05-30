<?php
include 'includes/session.php';
include 'includes/header.php';
include 'includes/menubar.php';

// Retrieve the order status update from the URL parameter
$status = $_GET['status'];

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

?>

<body>
    <main>
        <section class="py-4 section-1">
            <div class="container py-1">
                <div class="row text-center">
                    <div class="col-lg-12 mx-auto">
                        <h1>Order Status</h1>
                        <p class="text-muted lead">Update if the order is ongoing, received, or cancelled.</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="container-fluid" style="background-color: white;">
                    <div class="container"> <br>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">activeOrder_id</th>
                                    <th scope="col">product_name</th>
                                    <th scope="col">customer_name</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">amount</th>
                                    <th scope="col">date_created</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conn = $pdo->open();
                                $stmt = $conn->query('SELECT op.activeOrder_id, p.product_name, c.customer_name, op.quantity, op.amount, op.date_created, op.status
                                                    FROM on_processorder_tbl op
                                                    INNER JOIN customer_tbl c ON op.customer_id = c.customer_id
                                                    INNER JOIN product_tbl p ON op.product_id = p.product_id');
                                while ($row = $stmt->fetch()) {
                                    echo '<tr>';
                                    echo '<td data-label="activeOrder_id">' . $row['activeOrder_id'] . '</td>';
                                    echo '<td data-label="product_name">' . $row['product_name'] . '</td>';
                                    echo '<td data-label="customer_name">' . $row['customer_name'] . '</td>';
                                    echo '<td data-label="quantity">' . $row['quantity'] . '</td>';
                                    echo '<td data-label="amount">' . $row['amount'] . '</td>';
                                    echo '<td data-label="date_created">' . $row['date_created'] . '</td>';
                                    echo '<td data-label="Status">';
                                    // Add the update status button
                                    echo '<button class="btn btn-primary btn-sm" onclick="updateStatus(' . $row['activeOrder_id'] . ')">Update Status</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                $pdo->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/javascripts.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Function to update the order status
        function updateStatus(orderID) {
            Swal.fire({
                title: 'Select Order Status',
                input: 'select',
                inputOptions: {
                    ongoing: 'Ongoing',
                    received: 'Received',
                    cancelled: 'Cancelled'
                },
                showCancelButton: true,
                confirmButtonText: 'Update',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please select an order status';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make an AJAX request to update_order_status.php
                    fetch(`update_order_status.php?activeOrder_id=${orderID}&status=${result.value}`)
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                // Display success notification
                                Swal.fire({
                                    title: 'Order Status Updated',
                                    text: 'The order status has been updated successfully',
                                    icon: 'success',
                                }).then(() => {
                                    // Reload the page to reflect the changes
                                    location.reload();
                                });
                            } else {
                                // Display error notification
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    icon: 'error',
                                });
                            }
                        })
                        .catch((error) => {
                            // Display error notification
                            Swal.fire({
                                title: 'Error',
                                text: 'An error occurred while updating the order status',
                                icon: 'error',
                            });
                        });
                }
            });
        }
    </script>
</body>
</html>
