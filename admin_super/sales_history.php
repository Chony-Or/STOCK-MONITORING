<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>

<!-- ================================================== BODY ================================================== -->

<body>

    <!-- .................... MAIN BODY CONTENT .................... -->
    <main>

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
                                    <th scope="col">transac_id</th>
                                    <th scope="col">customer_name</th>
                                    <th scope="col">product_name</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">amount</th>
                                    <th scope="col">status</th>
                                    <th scope="col">date created</th>
                                </tr>

                            </thead> <!-- End of Table Headers -->

                            <!-- Table Body -->
                            <tbody>

                                <?php
                                // Retrieve sales history data with customer and product information
                                try {
                                    $conn = $pdo->open();

                                    $selectQuery = 'SELECT t.transac_id, c.customer_name, p.product_name, t.quantity, t.amount, t.status, t.date_created
                                                    FROM transachistory_tbl t
                                                    INNER JOIN customer_tbl c ON t.customer_id = c.customer_id
                                                    INNER JOIN product_tbl p ON t.product_id = p.product_id';
                                    $stmt = $conn->prepare($selectQuery);
                                    $stmt->execute();
                                    $salesHistory = $stmt->fetchAll();

                                    foreach ($salesHistory as $sale) {
                                        echo '<tr>';
                                        echo '<td data-label="transac_id">' . $sale['transac_id'] . '</td>';
                                        echo '<td data-label="customer_name">' . $sale['customer_name'] . '</td>';
                                        echo '<td data-label="product_name">' . $sale['product_name'] . '</td>';
                                        echo '<td data-label="quantity">' . $sale['quantity'] . '</td>';
                                        echo '<td data-label="amount">' . $sale['amount'] . '</td>';
                                        echo '<td data-label="status">' . $sale['status'] . '</td>';
                                        echo '<td data-label="date created">' . $sale['date_created'] . '</td>';
                                        echo '</tr>';
                                    }

                                    $pdo->close();
                                } catch (PDOException $e) {
                                    echo 'Failed to retrieve sales history: ' . $e->getMessage();
                                }
                                ?>

                            </tbody> <!-- End of Table Body -->

                        </table> <!-- END OF TABLE -->


                    </div> <!-- END OF CONTAINER OF TABLE -->

                </div> <!-- END OF CONTAINER FLUID OF TABLE -->

        </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

    </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

    <?php include 'includes/javascripts.php'; ?>


</body>

</html>
