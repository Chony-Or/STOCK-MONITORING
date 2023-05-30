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
                        <p class="text-muted lead">Update if the order is received, ongoing, or cancelled.</p>

                    </div>

                </div>

            </div>

        </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->

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
                                    <th scope="col">activeOrder_id</th>
                                    <th scope="col">product_name</th>
                                    <th scope="col">customer_name</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">amount</th>
                                    <th scope="col">date_created</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead> <!-- End of Table Headers -->

                            <!-- Table Body -->
                            <tbody>
                                <?php
                                // Fetch data from on_processorder_tbl with customer and product details
                                $conn = $pdo->open();
                                $stmt = $conn->query('SELECT op.activeOrder_id, p.product_name, c.customer_name, op.quantity, op.amount, op.date_created
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
                                    echo '</tr>';
                                }
                                $pdo->close();
                                ?>
                            </tbody> <!-- End of Table Body -->

                        </table> <!-- END OF TABLE -->

                    </div> <!-- END OF CONTAINER OF TABLE -->

                </div> <!-- END OF CONTAINER FLUID OF TABLE -->

            </div>

        </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

    </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

    <?php include 'includes/javascripts.php'; ?>

</body>

</html>

