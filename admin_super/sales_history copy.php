<?php

include 'includes/session.php';
include 'includes/header.php';
include 'includes/menubar.php';

// Initialize the search query variable
$search_query = '';

// Check if the search form has been submitted
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// Function to filter the sales history based on the search query
function filterSalesHistory($salesHistory, $searchQuery)
{
    // Array to store filtered sales history
    $filteredHistory = [];

    foreach ($salesHistory as $sale) {
        // Check if any column value matches the search query
        if (
            strpos(strtolower($sale['transac_id']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($sale['customer_firstname']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($sale['customer_lastname']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($sale['product_name']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($sale['quantity']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($sale['amount']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($sale['status']), strtolower($searchQuery)) !== false ||
            strpos(strtolower($sale['date_created']), strtolower($searchQuery)) !== false
        ) {
            // Add the matching sales record to the filtered history
            $filteredHistory[] = $sale;
        }
    }

    return $filteredHistory;
}

// Function to check if the sales history is filtered or not
function isSalesHistoryFiltered($searchQuery)
{
    return !empty($searchQuery);
}

?>

<!-- ================================================== BODY ================================================== -->

<body>

    <!-- .................... MAIN BODY CONTENT .................... -->
    <main>

        <!-- ------------------------------ Title and Search Bar ------------------------------ -->
        <section class="py-4 section-1">

            <div class="container py-1">

                <div class="row text-center">

                    <div class="col-lg-12 mx-auto">

                        <h1> <b> Sales History </b> </h1>
                        <p>History of Received and Cancelled Orders</p>

                        <div id="wrap">

                            <form action="" autocomplete="on">
                                <input id="search" name="search" type="text" placeholder="What're we looking for ?" value="<?php echo $search_query; ?>">
                                <input id="search_submit" value="Rechercher" type="submit"> <br><br><br>
                                <?php if (isSalesHistoryFiltered($search_query)) : ?>
                                    <a href="sales_history.php" class="btn btn-secondary">Reset Search</a>
                                <?php endif; ?>
                            </form>
                        </div>

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
                                    <th scope="col">Transaction Number</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                </tr>

                            </thead> <!-- End of Table Headers -->

                            <!-- Table Body -->
                            <tbody>

                                <?php
                                // Retrieve sales history data with customer and product information
                                try {
                                    $conn = $pdo->open();

                                    $selectQuery = 'SELECT t.transac_id, c.customer_firstname, c.customer_lastname, p.product_name, t.quantity, t.amount, t.status, t.date_created
                                                            FROM transachistory_tbl t
                                                            INNER JOIN customer_tbl c ON t.customer_id = c.customer_id
                                                            INNER JOIN product_tbl p ON t.product_id = p.product_id';
                                    $stmt = $conn->prepare($selectQuery);
                                    $stmt->execute();
                                    $salesHistory = $stmt->fetchAll();

                                    // Filter sales history if search query is present
                                    if (!empty($search_query)) {
                                        $salesHistory = filterSalesHistory($salesHistory, $search_query);
                                    }


                                    foreach ($salesHistory as $sale) {

                                        // Format the date_created column to the desired format (e.g., "d F Y, h:i A")
                                        $formattedDate = date('d F Y, h:i A', strtotime($sale['date_created']));

                                        echo '<tr>';

                                        echo    '<td data-label="Transaction Number">' . $sale['transac_id'] . '</td>';
                                        echo    '<td data-label="Customer">' . $sale['customer_firstname'] . ' ' . $sale['customer_lastname'] . '</td>';
                                        echo    '<td data-label="Product">' . $sale['product_name'] . '</td>';
                                        echo    '<td data-label="Quantity">' . $sale['quantity'] . '</td>';
                                        echo    '<td data-label="Amount">' . $sale['amount'] . '</td>';

                                        // Apply font color based on status
                                        if ($sale['status'] == 'Received') {
                                            echo '<td data-label="Status" style="color: green;">' . $sale['status'] . '</td>';
                                        } elseif ($sale['status'] == 'Cancelled') {
                                            echo '<td data-label="Status" style="color: red;">' . $sale['status'] . '</td>';
                                        } else {
                                            echo '<td data-label="Status">' . $sale['status'] . '</td>';
                                        }
                                        echo    '<td data-label="Date">' . $formattedDate . '</td>';

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

            </div>

        </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

    </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

    <?php include 'includes/javascripts.php'; ?>

</body>

</html>