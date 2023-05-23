<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>

<!-- ================================================== BODY ================================================== -->
<body>
    <!-- .................... MAIN BODY CONTENT .................... -->
    <main>
        <!-- ------------------------------ Title and Search Bar ------------------------------ -->
        <section class="py-4 section-1">
            <div class="container py-1">
                <div class="row text-center">
                    <div class="col-lg-12 mx-auto">
                        <h1>Order Status</h1>
                        <p class="text-muted lead">Update if the order is received, ongoing, or cancelled</p>
                        <div id="wrap">
                            <form action="" autocomplete="on">
                                <input id="search" name="search" type="text" placeholder="What're we looking for ?" value="<?php echo $search_query; ?>">
                                <input id="search_submit" value="Rechercher" type="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->

        <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
        <section>
            <div class="container">
                <!-- TABLE CONTAINER -->
                <div class="container-fluid" style="background-color: white;">
                    <div class="container"> <br>
                        <table>
                            <!-- Table Headers -->
                            <thead>
                                <tr>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <!-- End of Table Headers -->
                            <!-- Table Body -->
                            <tbody>
                                <!-- Nalimot ko purpose pero para sa database to pang fetch ata ng data -->
                                <?php if (!empty($result)) {
                                    foreach ($result as $row) { ?>
                                        <tr>
                                            <!-- PHP Data Fetch to Display -->
                                            <td data-label="Customer ID"> </td>
                                            <td data-label="Name"> </td>
                                            <td data-label="Address"> </td>
                                            <td data-label="Contact"> </td>
                                            <td data-label="Created By"> </td>
                                            <td data-label="Updated By"> </td>
                                            <td data-label="">
                                                <td>
                                                    <button type="button" class="btn btn-success" onclick="acceptOrder(<?php echo $row['orderNumber']; ?>)">Accept</button>
                                                    <button type="button" class="btn btn-danger" onclick="declineOrder(<?php echo $row['orderNumber']; ?>)">Decline</button>
                                                </td>
                                            </td>
                                            <!-- Include Modal php -->
                                            <?php include('user_regular_modal.php'); ?>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                            <!-- End of Table Body -->
                        </table>
                        <!-- END OF TABLE -->
                    </div>
                    <!-- END OF CONTAINER OF TABLE -->
                </div>
                <!-- END OF CONTAINER FLUID OF TABLE -->
            </div>
        </section>
        <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->
    </main>
    <!-- .................... END OF MAIN BODY CONTENT .................... -->
    <?php include 'includes/javascripts.php'; ?>
    <script>
        function acceptOrder(orderNumber) {
            // Perform the necessary actions to accept the order
            // You can use JavaScript, AJAX, or submit a form to handle the action
            $.ajax({
                url: 'accept_order.php',
                method: 'POST',
                data: {
                    orderNumber: orderNumber
                },
                success: function(response) {
                    if (response === 'success') {
                        // Reload the page after successful acceptance
                        location.reload();
                    } else {
                        // Show an error message
                        alert('Failed to accept the order.');
                    }
                },
                error: function() {
                    // Show an error message
                    alert('An error occurred while processing the request.');
                }
            });
        }

        function declineOrder(orderNumber) {
            // Perform the necessary actions to decline the order
            // You can use JavaScript, AJAX, or submit a form to handle the action
            $.ajax({
                url: 'decline_order.php',
                method: 'POST',
                data: {
                    orderNumber: orderNumber
                },
                success: function(response) {
                    if (response === 'success') {
                        // Remove the row from the table after successful decline
                        $('#row_' + orderNumber).remove();
                    } else {
                        // Show an error message
                        alert('Failed to decline the order.');
                    }
                },
                error: function() {
                    // Show an error message
                    alert('An error occurred while processing the request.');
                }
            });
        }
    </script>
</body>

</html>
