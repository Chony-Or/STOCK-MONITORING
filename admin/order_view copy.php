<?php
include 'includes/session.php';
include 'includes/header.php';
include 'includes/menubar.php';

// Retrieve the order number from the URL parameter
$orderNumber = $_GET['order_number'];

// Function to display the order summary
function displayOrderSummary($orderNumber)
{
    global $pdo;

    // Fetch order summary with customer information and product details from the database using a join query
    $conn = $pdo->open();
    $stmt = $conn->prepare('SELECT po.pendingOrder_id, po.order_number, c.customer_name, p.product_name, po.quantity, po.amount
                           FROM pendingorder_tbl po
                           INNER JOIN customer_tbl c ON po.customer_id = c.customer_id
                           INNER JOIN product_tbl p ON po.product_id = p.product_id
                           WHERE po.order_number = :orderNumber');
    $stmt->execute(['orderNumber' => $orderNumber]);
    $orderSummary = $stmt->fetchAll();

    if ($orderSummary) {
        // Display the customer name and order number outside the table
        echo '<div class="container">';
        echo '<h2>Order Number: ' . $orderSummary[0]['order_number'] . '</h2>';
        echo '<h3>Customer Name: ' . $orderSummary[0]['customer_name'] . '</h3>';

        // Display the order summary table
        echo '<div class="container-fluid" style="background-color: white;">';
        echo '<div class="container"><br>';
        echo '<button class="btn btn-success" onclick="acceptAllOrders()">Accept All</button>';
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Product Name</th>';
        echo '<th scope="col">Quantity</th>';
        echo '<th scope="col">Amount</th>';
        echo '<th scope="col">Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $totalQuantity = 0;
        $totalAmount = 0;

        // Loop through the order summary and display the details in the table
        foreach ($orderSummary as $order) {
            echo '<tr>';
            echo '<td data-label="Product Name">' . $order['product_name'] . '</td>';
            echo '<td data-label="Quantity">' . $order['quantity'] . '</td>';
            echo '<td data-label="Amount">' . $order['amount'] . '</td>';
            echo '<td data-label="Actions">';
            echo '<button class="btn btn-danger btn-sm" onclick="removeOrder(' . $order['pendingOrder_id'] . ')">Remove</button>';
            echo '</td>';
            echo '</tr>';

            // Accumulate the total quantity and total amount
            $totalQuantity += $order['quantity'];
            $totalAmount += $order['amount'];
        }

        echo '</tbody>';
        echo '</table>';

        // Display the total quantity and total amount outside the table
        echo '<p>Total Quantity: ' . $totalQuantity . '</p>';
        echo '<p>Total Amount: ' . $totalAmount . '</p>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        // Display an error message if the order summary is not found
        echo '<p>Order summary not found.</p>';
    }

    $pdo->close();
}
?>

<body>
    <main>
        <section>
            <?php displayOrderSummary($orderNumber); ?>
        </section>
    </main>
    <?php include 'includes/javascripts.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Function to remove the order
        function removeOrder(orderId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to remove this order',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Remove',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make an AJAX request to remove_order.php
                    fetch(`order_remove.php?pendingOrder_id=${orderId}`)
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                // Display success notification
                                Swal.fire({
                                    title: 'Order Removed',
                                    text: 'The order has been removed successfully',
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
                                text: 'An error occurred while removing the order',
                                icon: 'error',
                            });
                        });
                }
            });
        }
        
        // Function to accept all orders
        function acceptAllOrders() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to accept all orders',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Accept All',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make an AJAX request to accept_all_orders.php
                    fetch('orders_accept.php')
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                // Display success notification
                                Swal.fire({
                                    title: 'Orders Accepted',
                                    text: 'All orders have been accepted successfully',
                                    icon: 'success',
                                }).then(() => {
                                    // Redirect to a new page or perform any additional actions
                                    // Here, we are redirecting to the home page
                                    window.location.href = 'order_status.php';
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
                                text: 'An error occurred while accepting the orders',
                                icon: 'error',
                            });
                        });
                }
            });
        }
    </script>
</body>
</html>
