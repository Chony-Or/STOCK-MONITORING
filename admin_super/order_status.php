<?php

    include 'includes/session.php';
    include 'includes/header.php';
    include 'includes/menubar.php';

    // Retrieve the order status update from the URL parameter
    $status = isset($_GET['status']) ? $_GET['status'] : null;

    // Function to update the order status
    function updateOrderStatus($orderID, $status)
    {
        global $pdo;

        try
        {
            $conn = $pdo->open();

            // Update the order status in the on_processorder_tbl table
            $updateQuery = 'UPDATE on_processorder_tbl SET status = :status WHERE activeOrder_id = :orderID';
            $stmt = $conn->prepare($updateQuery);
            $stmt->execute(['status' => $status, 'orderID' => $orderID]);

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

    <body>

        <main>

            <!-- ------------------------------ HEADER SECTION ------------------------------ -->
            <section class="py-4 section-1">

                <div class="container py-1">

                    <div class="row text-center">

                        <div class="col-lg-12 mx-auto">
                            <h1> <b> Order Status </b> </h1>
                            <p>Update the status if the order is In Process, Out for Delivery, Delivery is Done and Cancelled</p>
                        </div>

                    </div>

                </div>

            </section> <!-- ------------------------------ HEADER SECTION END ------------------------------ -->










            <!-- ------------------------------ ORDER STATUS TABLE SECTION ------------------------------ -->
            <section>

                <div class="container">

                    <div class="container-fluid" style="background-color: white;">

                        <div class="container"> <br>

                            <!-- TABLE -->
                            <table>

                                <!-- Table Headers -->
                                <thead>

                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Action</th>
                                    </tr>

                                </thead>

                                <!-- Table Body -->
                                <tbody>

                                    <?php
                                        $conn = $pdo->open();
                                        $stmt = $conn->query('SELECT op.activeOrder_id, p.product_name, c.customer_firstname, c.customer_lastname, op.quantity, op.amount, op.date_created, op.status
                                                        FROM on_processorder_tbl op
                                                        INNER JOIN customer_tbl c ON op.customer_id = c.customer_id
                                                        INNER JOIN product_tbl p ON op.product_id = p.product_id');

                                        while ($row = $stmt->fetch())
                                        {
                                            echo '<tr>';

                                            echo    '<td data-label="ID">' . $row['activeOrder_id'] . '</td>';
                                            echo    '<td data-label="Product">' . $row['product_name'] . '</td>';
                                            echo    '<td data-label="Customer">' . $row['customer_firstname'] . ' ' . $row['customer_lastname'] . '</td>';
                                            echo    '<td data-label="Quantity">' . $row['quantity'] . '</td>';
                                            echo    '<td data-label="Amount">' . $row['amount'] . '</td>';

                                            // Add font color based on status
                                            $status = $row['status'];
                                            $color = '';

                                            switch ($status)
                                            {
                                                case 'In Process':
                                                    $color = 'blue';
                                                break;

                                                case 'Out for Delivery':
                                                    $color = '#FFA500';
                                                break;

                                                case 'Received':
                                                    $color = 'green';
                                                break;

                                                case 'Cancelled':
                                                    $color = 'red';
                                                break;

                                                default:
                                                    $color = 'black';
                                                break;
                                            }

                                            echo    '<td data-label="Status"><span style="color:' . $color . ';">' . $status . '</span></td>';
                                            echo    '<td data-label="Date Created">' . $row['date_created'] . '</td>';
                                            echo    '<td data-label="Action">';
                                            echo        '<button class="btn btn-primary btn-sm" onclick="updateStatus(' . $row['activeOrder_id'] . ')">Update Status</button>';
                                            echo    '</td>';

                                            echo '</tr>';
                                        }

                                        $pdo->close();
                                    ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </section> <!-- ------------------------------ ORDER STATUS TABLE SECTION END ------------------------------ -->




            <!-- ------------------------------ SALE HISTORY LINK SECTION ------------------------------ -->
            <section class="py-4 section-1">

                <div class="container py-1">

                    <div class="col-lg-12 mx-auto">
                            
                        <!-- Sales History Link -->
                        <a href="sales_history.php" class="nav__link text-end">
                            <i class='bx bx-history nav__icon'></i> Go to Sales History
                        </a>

                    </div>

                </div>

            </section> <!-- ------------------------------ SALE HISTORY LINK SECTION END ------------------------------ -->

        </main>

        <?php include 'includes/javascripts.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>

            // Function to update the order status
            function updateStatus(orderID)
            {
                Swal.fire({
                    title: 'Select Order Status',
                    input: 'select',
                    inputOptions:
                    {
                        ongoing: 'In Process',
                        delivery: 'Out for Delivery',
                        received: 'Delivery is Done',
                        cancelled: 'Cancelled'
                    },

                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel',
                    inputValidator: (value) =>
                    {
                        if (!value)
                        {
                            return 'Please select an order status';
                        }
                    }

                }).then((result) =>
                {
                    if (result.isConfirmed)
                    {
                        // Make an AJAX request to order_update.php
                        fetch(`order_update.php?activeOrder_id=${orderID}&status=${result.value}`)
                        .then((response) => response.json())
                        .then((data) =>
                        {
                            if (data.success)
                            {
                                // Display success notification
                                Swal.fire({
                                    title: 'Order Status Updated',
                                    text: 'The order status has been updated successfully',
                                    icon: 'success',
                                }).then(() =>
                                {
                                    // Reload the page to reflect the changes
                                    location.reload();
                                });
                            }
                            else
                            {
                                // Display error notification
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    icon: 'error',
                                });
                            }
                        })
                        .catch((error) =>
                        {
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