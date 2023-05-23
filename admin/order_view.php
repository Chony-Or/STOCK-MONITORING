<?php
include 'includes/session.php';
include 'includes/header.php';
include 'includes/menubar.php';

$conn = $pdo->open();

// Fetch pending orders
$query = "SELECT * FROM pendingorder_tbl";
$result = $conn->query($query);
$pendingOrders = $result->fetchAll(PDO::FETCH_ASSOC);

// Close the database connection
$pdo = null;
?>

<!-- ================================================== BODY ================================================== -->

<body>

    <!-- .................... MAIN BODY CONTENT .................... -->
    <main>

        <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
        <section>
            <?php if (!empty($pendingOrders)) : ?>
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($pendingOrders as $order) : ?>
                        <tr>
                            <td><?php echo $order['product_name']; ?></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo $order['amount']; ?></td>
                            <td>
                                <button type="button" class="btn btn-success" onclick="acceptOrder(<?php echo $order['order_number']; ?>)">Accept</button>
                                <button type="button" class="btn btn-danger" onclick="declineOrder(<?php echo $order['order_number']; ?>)">Decline</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <p>No pending orders.</p>
            <?php endif; ?>
        </section>

    </main>

    <!-- .................... END OF MAIN BODY CONTENT .................... -->

    <?php include 'includes/javascripts.php'; ?>

    <script>
        function acceptOrder(orderNumber) {
            // Perform the necessary actions to accept the order
            // You can use JavaScript, AJAX, or submit a form to handle the action
            $.ajax({
                url: 'order_status.php',
                method: 'POST',
                data: {
                    orderNumber: orderNumber,
                    action: 'accept'
                },
                success: function(response) {
                    console.log(response);
                    // Handle the success response
                },
                error: function() {
                    // Handle the error case
                    alert('An error occurred while processing the request.');
                }
            });
        }

        function declineOrder(orderNumber) {
            // Perform the necessary actions to decline the order
            // You can use JavaScript, AJAX, or submit a form to handle the action
            $.ajax({
                url: 'order_status.php',
                method: 'POST',
                data: {
                    orderNumber: orderNumber,
                    action: 'decline'
                },
                success: function(response) {
                    console.log(response);
                    // Handle the success response
                },
                error: function() {
                    // Handle the error case
                    alert('An error occurred while processing the request.');
                }
            });
        }
    </script>

</body>

</html>
