<?php include 'includes/session.php'; ?>

<?php
$conn = $pdo->open();

if ($stmt = $conn->prepare('SELECT *, pendingorder_tbl.pendingOrder_id AS pending FROM pendingorder_tbl 
                                LEFT JOIN customer_tbl ON customer_tbl.customer_id=pendingorder_tbl.customer_id GROUP BY order_number ORDER BY pendingorder_id')) {
    // Calculate the page to get the results we need from our table.
    $stmt->execute();

    // Get the results...
    $result = $stmt->fetchAll();
?>

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

                            <h1> <b> DASHBOARD </b> </h1>
                            <p class="text-muted lead"> Welcome to the Dashboard, you have login as a Super Admin </p>
                            <p> This page consist of Overviews, Pending Orders and Chart that shows the stock of the products </p>

                        </div>

                    </div>

                </div>

            </section> <br> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->

            <p class="text-start"> <b> <?php echo date('l') . ' ' . date('d') . ', ' . date('Y'); ?> </b></p> <!-- DATE -->










            <!-- ------------------------------ CARD and PENDING ORDER ------------------------------ -->
            <section>

                <!-- Extra container I forgot the purpose -->
                <div class="container-fluid">

                    <!-- Row -->
                    <div class="row justify-content-around">

                        <!-- COLUMN 1 -->
                        <div class="col-sm-6 p-3 border border-3 text-center" style="background-color: white; --bs-border-color: #f5f5f5;"> <br>

                            <h4> <b> Overview </b> </h4> <br>

                            <!-- Row -->
                            <div class="row justify-content-around">

                                <!-- COLUMN 1 -->
                                <div class="col-sm-6 p-3">

                                    <!-- No. of Purchase -->
                                    <span class="badge d-flex align-items-center p-1 pe-2 text-success-emphasis bg-success-subtle border border-success-subtle rounded-pill">
                                        <img src="../images/Purchase.png" class="rounded-circle me-1" width="35" height="35" alt="..."> Purchase

                                            <?php
                                                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transachistory_tbl");
                                                $stmt->execute();
                                                $urow =  $stmt->fetch();

                                                echo "<p class='card-text'> : "  . $urow['numrows'] . "</p>";
                                            ?>

                                    </span> <br> <br>

                                    <!-- Total Products -->
                                    <span class="badge d-flex align-items-center p-1 pe-2 text-warning-emphasis bg-warning-subtle border border-warning-subtle rounded-pill">
                                        <img src="../images/Product.png" class="rounded-circle me-1" width="35" height="35" alt="..."> Total Products

                                            <?php
                                                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM product_tbl");
                                                $stmt->execute();
                                                $urow =  $stmt->fetch();

                                                echo "<p class='card-text'> : " . $urow['numrows'] . "</p>";
                                            ?>
                                    </span>

                                </div>

                                <!-- COLUMN 2 -->
                                <div class="col-sm-6 p-3">

                                    <!-- Total Users -->
                                    <span class="badge d-flex align-items-center p-1 pe-2 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-pill">
                                        <img src="../images/Users.png" class="rounded-circle me-1" width="35" height="35" alt="..."> Total Users

                                            <?php
                                                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM customer_tbl");
                                                $stmt->execute();
                                                $urow =  $stmt->fetch();

                                                echo "<p class='card-text'> : " . $urow['numrows'] . "</p>";
                                            ?>
                                    </span> <br> <br>

                                    <!-- Pending Orders -->
                                    <span class="badge d-flex align-items-center p-1 pe-2 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill">
                                        <img src="../images/Pending.png" class="rounded-circle me-1" width="35" height="35" alt="..."> Pending Orders
                                        
                                            <?php
                                                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM pendingorder_tbl");
                                                $stmt->execute();
                                                $urow =  $stmt->fetch();

                                                echo "<p class='card-text'> : " . $urow['numrows'] . "</p>";
                                            ?>
                                    </span>

                                </div>

                            </div> <br> <br>

                        </div>

                        <!-- COLUMN 2 PENDING ORDERS -->
                        <div class="col-sm-6 p-3 border border-3" style="background-color: white; --bs-border-color: #f5f5f5;">

                            <div class="container-fluid" style="background-color: white;"> <br>
                            
                                <h4><b>Pending Orders</b></h4> <br>

                                <!-- Scrollable bar -->
                                <div class="scrollable-bar" style="max-height: 300px; overflow: auto;">

                                    <!-- TABLE -->
                                    <table class="table">

                                        <!-- Table Header -->
                                        <thead>

                                            <tr>
                                                <th scope="col">Order No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">View</th>
                                            </tr>

                                        </thead>

                                        <!-- Table Body -->
                                        <tbody>

                                            <?php if (!empty($result)) { foreach ($result as $row) { ?>

                                            <tr>

                                                <td data-label="Order No."><?php echo $row['order_number']; ?></td>
                                                <td data-label="Name"><?php echo $row['customer_firstname'] . ' ' . $row['customer_lastname']; ?></td>
                                                <td data-label="Time"><?php echo $row['date_created']; ?></td>
                                                <td data-label="View">
                                                    <a href="order_view.php?order_number=<?php echo $row['order_number']; ?>" class="btn btn-primary btn-sm">
                                                        <span><i class='bx bx-search-alt'></i></span>
                                                    </a>
                                                </td>

                                            </tr>
                                            
                                            <?php } } ?>

                                        </tbody>

                                    </table> <!-- End of TABLE -->

                                    <?php $pdo->close(); } ?>

                                </div>

                            </div> <br> <!-- ------------------------------ END OF PENDING ORDERS ------------------------------ -->

                        </div>

                    </div>

                </div>

            </section> <br> <!-- ------------------------------ End of CARD and PENDING ORDER ------------------------------ -->










            <!-- ------------------------------ LOW STOCK SECTION ------------------------------ -->
            <section>

                <!-- Low Stock Preview -->
                <span class="badge d-flex align-items-center p-1 pe-2 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill" data-bs-toggle="modal" data-bs-target="#lowStockModal">

                    <img src="../images/Low Stock.png" class="rounded-circle me-1" width="45" height="45" alt="..."> Low Stock
                    
                        <span class="vr mx-2"></span>
                            <?php
                                $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM product_tbl WHERE product_stock < 10");
                                $stmt->execute();
                                $urow =  $stmt->fetch();

                                echo "<p class='card-text'>" . $urow['numrows'] . "</p>";
                            ?>

                </span> <br>

                <!-- Modal -->
                <?php
                    
                    // Fetch products with low stock
                    $stmt = $conn->prepare('SELECT * FROM product_tbl WHERE product_stock < 10');
                    $stmt->execute();
                    $lowStockProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                ?>

                <div class="modal fade" id="lowStockModal" tabindex="-1" aria-labelledby="lowStockModalLabel" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="lowStockModalLabel">Low Stock Products</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>

                            <div class="modal-body">

                                <?php if (count($lowStockProducts) > 0) : ?>

                                    <ul class="list-group">

                                        <?php foreach ($lowStockProducts as $product) : ?>

                                            <li class="list-group-item">
                                                <a href="product_info.php?id=<?= $product['product_id'] ?>">
                                                    <?= $product['product_name'] ?> (Stock: <?= $product['product_stock'] ?>)
                                                </a>
                                            </li>

                                        <?php endforeach; ?>
                                    </ul>

                                    <script>

                                        // JavaScript code to display the pop-up notification
                                        var lowStockProducts = <?php echo json_encode($lowStockProducts); ?>;
                                        showNotification(lowStockProducts);

                                    </script>

                                <?php else : ?>

                                <p>No low stock products found.</p>

                                <?php endif; ?>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>

                    </div>

                </div>

            </section>
            <!-- ------------------------------ END OF LOW STOCK ------------------------------ -->










            <!-- ------------------------------ CHART SECTION ------------------------------ -->
            <section>

                <div class="container-fluid border border-3" style="background-color: white; --bs-border-color: #f5f5f5;"> <br>

                    <h3> CHART </h3>

                    <!-- Add a container for the chart -->
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>

                    <!-- Include the necessary JavaScript libraries -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    <!-- Add a JavaScript code block -->
                    <script>

                        // Function to update the chart
                        function updateChart()
                        {
                            $.ajax({
                                url: 'index_fetch_chart_data.php',
                                method: 'GET',
                                dataType: 'json',
                                success: function(data)
                                {
                                    // Get the chart data from the JSON response
                                    var chartData = data;

                                    // Create the chart using Chart.js
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var chart = new Chart(ctx, {
                                        type: 'bar',
                                        data:
                                        {
                                            labels: chartData.labels,
                                            datasets: [{
                                                label: 'Product Stock',
                                                data: chartData.values,
                                                backgroundColor: chartData.colors,
                                                borderColor: chartData.colors,
                                                borderWidth: 1
                                            }]
                                        },
                                        options:
                                        {
                                            scales:
                                            {
                                                y:
                                                {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                }
                            });
                        }

                        // Call the updateChart function initially
                        updateChart();

                        // Set an interval to update the chart every 5 seconds (adjust as needed)
                        setInterval(updateChart, 5000);

                    </script>

                </div>

            </section> <!-- ------------------------------ END OF CHART SECTION ------------------------------ -->

        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?> <!-- Call javascripts -->

    </body>

</html>