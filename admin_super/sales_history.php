<?php

    include 'includes/session.php';
    include 'includes/header.php';
    include 'includes/menubar.php';

    // Define the number of results per page
    $resultsPerPage = 20;

    // Retrieve the current page number from the URL parameters
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Initialize the search query variable
    $search_query = '';

    // Check if the search form has been submitted
    if (isset($_GET['search']))
    {
        $search_query = $_GET['search'];
    }

    // Function to filter the sales history based on the search query
    function filterSalesHistory($salesHistory, $searchQuery)
    {
        // Array to store filtered sales history
        $filteredHistory = [];

        foreach ($salesHistory as $sale)
        {
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
            )
            {
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

    // Function to generate the sorting URL
    function generateSortUrl($column, $currentSort, $currentOrder)
    {
        $newOrder = ($currentSort === $column && $currentOrder === 'asc') ? 'desc' : 'asc';
        return "sales_history.php?sort=$column&order=$newOrder";
    }

    // Retrieve the current sort column and order from the URL parameters
    $currentSort = isset($_GET['sort']) ? $_GET['sort'] : 'transac_id';
    $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

    // Function to generate the sort icon based on the current sort column and order
    function generateSortIcon($column, $currentSort, $currentOrder)
    {
        if ($currentSort === $column)
        {
            $icon = ($currentOrder === 'asc') ? 'fa-sort-up' : 'fa-sort-down';
            return "<i class='fas $icon'></i>";
        }
        return '';
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
                                        <a href="sales_history.php" class="reset-search">Reset Search</a>
                                    <?php endif; ?>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->










            <!-- ------------------------------ CONTENT SECTION SALES HISTORY ------------------------------ -->
            <section>

                <div class="container">

                    <a href="index.php" class="nav__link"> <i class='bx bx-arrow-back nav__icon'></i> Go back to Dashboard </a> <br>

                    <!-- TABLE CONTAINER -->
                    <div class="container-fluid" style="background-color: white;">

                        <div class="container"> <br>

                            <table>

                                <!-- Table Headers -->
                                <thead>

                                    <tr>

                                        <!-- Headers TRANSACTION NUMBER -->
                                        <th scope="col">
                                            <a href="sales_history.php?sort=transac_id&order=<?php echo ($currentSort === 'transac_id' && $currentOrder === 'asc') ? 'desc' : 'asc'; ?>">
                                                Transaction Number <?php echo ($currentSort === 'transac_id') ? ($currentOrder === 'asc' ? '<i class="bx bx-caret-up"></i>' : '<i class="bx bx-caret-down"></i>') : ''; ?>
                                            </a>
                                        </th>

                                        <!-- Headers CUSTOMER NAME -->
                                        <th scope="col">
                                            <a href="sales_history.php?sort=customer_firstname,customer_lastname&order=<?php echo ($currentSort === 'customer_fisrtname' . 'customer_lastname' && $currentOrder === 'asc') ? 'desc' : 'asc'; ?>">
                                                Customer Name <?php echo ($currentSort === 'customer_fisrtname' . 'customer_lastname') ? ($currentOrder === 'asc' ? '<i class="bx bx-caret-up"></i>' : '<i class="bx bx-caret-down"></i>') : ''; ?>
                                            </a>
                                        </th>

                                        <!-- Headers PRODUCT NAME -->
                                        <th scope="col">
                                            <a href="sales_history.php?sort=product_name&order=<?php echo ($currentSort === 'product_name' && $currentOrder === 'asc') ? 'desc' : 'asc'; ?>">
                                                Product Name <?php echo ($currentSort === 'product_name') ? ($currentOrder === 'asc' ? '<i class="bx bx-caret-up"></i>' : '<i class="bx bx-caret-down"></i>') : ''; ?>
                                            </a>
                                        </th>

                                        <!-- Headers QUANTITY -->
                                        <th scope="col">
                                            <a href="sales_history.php?sort=quantity&order=<?php echo ($currentSort === 'quantity' && $currentOrder === 'asc') ? 'desc' : 'asc'; ?>">
                                                Quantity <?php echo ($currentSort === 'quantity') ? ($currentOrder === 'asc' ? '<i class="bx bx-caret-up"></i>' : '<i class="bx bx-caret-down"></i>') : ''; ?>
                                            </a>
                                        </th>

                                        <!-- Headers AMOUNT -->
                                        <th scope="col">
                                            <a href="sales_history.php?sort=amount&order=<?php echo ($currentSort === 'amount' && $currentOrder === 'asc') ? 'desc' : 'asc'; ?>">
                                                Amount <?php echo ($currentSort === 'amount') ? ($currentOrder === 'asc' ? '<i class="bx bx-caret-up"></i>' : '<i class="bx bx-caret-down"></i>') : ''; ?>
                                            </a>
                                        </th>

                                        <!-- Headers STATUS -->
                                        <th scope="col">
                                            <a href="sales_history.php?sort=status&order=<?php echo ($currentSort === 'status' && $currentOrder === 'asc') ? 'desc' : 'asc'; ?>">
                                                Status <?php echo ($currentSort === 'status') ? ($currentOrder === 'asc' ? '<i class="bx bx-caret-up"></i>' : '<i class="bx bx-caret-down"></i>') : ''; ?>
                                            </a>
                                        </th>

                                        <!-- Headers DATE -->
                                        <th scope="col">
                                            <a href="sales_history.php?sort=date_created&order=<?php echo ($currentSort === 'date_created' && $currentOrder === 'asc') ? 'desc' : 'asc'; ?>">
                                                Date <?php echo ($currentSort === 'date_created') ? ($currentOrder === 'asc' ? '<i class="bx bx-caret-up"></i>' : '<i class="bx bx-caret-down"></i>') : ''; ?>
                                            </a>
                                        </th>

                                    </tr>

                                </thead> <!-- End of Table Headers -->

                                <!-- Table Body -->
                                <tbody>

                                    <?php

                                        // Retrieve sales history data with customer and product information
                                        try
                                        {
                                            $conn = $pdo->open();

                                            $selectQuery = 'SELECT t.transac_id, c.customer_firstname, c.customer_lastname, p.product_name, t.quantity, t.amount, t.status, t.date_created
                                                            FROM transachistory_tbl t
                                                            INNER JOIN customer_tbl c ON t.customer_id = c.customer_id
                                                            INNER JOIN product_tbl p ON t.product_id = p.product_id';

                                            // Check if a sort parameter is present in the URL
                                            $validSorts = ['transac_id', 'customer_firstname', 'customer_lastname', 'product_name', 'quantity', 'amount', 'status', 'date_created'];
                                            $validOrders = ['asc', 'desc'];
                                            $currentSort = (isset($_GET['sort']) && in_array($_GET['sort'], $validSorts)) ? $_GET['sort'] : 'transac_id';
                                            $currentOrder = (isset($_GET['order']) && in_array($_GET['order'], $validOrders)) ? $_GET['order'] : 'asc';

                                            // Add the sort parameters to the query
                                            $selectQuery .= ' ORDER BY ' . $currentSort . ' ' . $currentOrder;

                                            // Add pagination to the query
                                            $offset = ($currentPage - 1) * $resultsPerPage;
                                            $selectQuery .= ' LIMIT ' . $resultsPerPage . ' OFFSET ' . $offset;


                                            $stmt = $conn->prepare($selectQuery);
                                            $stmt->execute();
                                            $salesHistory = $stmt->fetchAll();

                                            // Filter sales history if search query is present
                                            if (!empty($search_query))
                                            {
                                                $salesHistory = filterSalesHistory($salesHistory, $search_query);
                                            }

                                            // Count the total number of results for pagination
                                            $countQuery = 'SELECT COUNT(*) as total FROM transachistory_tbl';
                                            $countStmt = $conn->prepare($countQuery);
                                            $countStmt->execute();
                                            $totalCount = $countStmt->fetch()['total'];


                                            foreach ($salesHistory as $sale)
                                            {

                                                // Format the date_created column to the desired format (e.g., "d F Y, h:i A")
                                                $formattedDate = date('d F Y, h:i A', strtotime($sale['date_created']));

                                                echo '<tr>';

                                                echo    '<td data-label="Transaction Number">' . $sale['transac_id'] . '</td>';
                                                echo    '<td data-label="Customer">' . $sale['customer_firstname'] . ' ' . $sale['customer_lastname'] . '</td>';
                                                echo    '<td data-label="Product">' . $sale['product_name'] . '</td>';
                                                echo    '<td data-label="Quantity">' . $sale['quantity'] . '</td>';
                                                echo    '<td data-label="Amount">' . $sale['amount'] . '</td>';

                                                // Apply font color based on status
                                                if ($sale['status'] == 'Received')
                                                {
                                                    echo '<td data-label="Status" style="color: green;">' . $sale['status'] . '</td>';
                                                }
                                                elseif ($sale['status'] == 'Cancelled')
                                                {
                                                    echo '<td data-label="Status" style="color: red;">' . $sale['status'] . '</td>';
                                                }
                                                else
                                                {
                                                    echo '<td data-label="Status">' . $sale['status'] . '</td>';
                                                }
                                                echo    '<td data-label="Date">' . $formattedDate . '</td>';

                                                echo '</tr>';
                                            }

                                            $pdo->close();
                                        }
                                        catch (PDOException $e)
                                        {
                                            echo 'Failed to retrieve sales history: ' . $e->getMessage();
                                        }
                                    ?>

                                </tbody> <!-- End of Table Body -->

                            </table> <!-- END OF TABLE -->

                            <!-- Display pagination links -->
                            <div class="pagination">
                            
                                <?php if ($currentPage > 1) : ?>
                                    <a href="sales_history.php?page=<?php echo ($currentPage - 1); ?>">Previous</a>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= ceil($totalCount / $resultsPerPage); $i++) : ?>
                                    <a href="sales_history.php?page=<?php echo $i; ?>" <?php echo ($currentPage === $i) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                                <?php endfor; ?>

                                <?php if ($currentPage < ceil($totalCount / $resultsPerPage)) : ?>
                                    <a href="sales_history.php?page=<?php echo ($currentPage + 1); ?>">Next</a>
                                <?php endif; ?>

                            </div>

                        </div> <!-- END OF CONTAINER OF TABLE -->

                    </div> <!-- END OF CONTAINER FLUID OF TABLE -->

                </div>

            </section> <!-- ------------------------------ CONTENT SECTION SALES HISTORY ------------------------------ -->

        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>

    </body>

</html>