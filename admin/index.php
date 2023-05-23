<?php include 'includes/session.php'; ?>

<?php

$conn = $pdo->open();

if ($stmt = $conn->prepare('SELECT *, pendingorder_tbl.pendingOrder_id AS pending FROM pendingorder_tbl LEFT JOIN customer_tbl ON customer_tbl.customer_id=pendingorder_tbl.customer_id GROUP BY order_number ORDER BY pendingorder_id')) {
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

                            <h1>DASHBOARD</h1>
                            <p class="text-muted lead"> Welcome to Dashboard, this consist of Overviews, Pending Orders and Chart of Stock </p>

                            <!-- <div id="wrap">
                                
                                <form action="" autocomplete="on">
                                    <input id="search" name="search" type="text" placeholder="What're we looking for ?" value="<?php //echo $search_query; 
                                                                                                                                ?>"><input id="search_submit" value="Rechercher" type="submit">
                                </form>

                            </div> -->

                        </div>

                    </div>

                </div>

            </section> <br> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->





            <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
            <section>

                <!-- ------------------------------ CARDS ------------------------------ -->
                <div class="row row-cols-1 row-cols-md-4 g-4">

                    <!-- Columns 1 PURCHASE -->
                    <div class="col">

                        <div class="card mb-3" style="max-width: 540px;">

                            <div class="row g-0">

                                <div class="col-md-4">
                                    <img src="../images/Purchase.png" class="img-fluid rounded-start" alt="...">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">No. of Purchase</h5>
                                        <?php
                                        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transachistory_tbl");
                                        $stmt->execute();
                                        $urow =  $stmt->fetch();

                                        echo "<p class='card-text'>" . $urow['numrows'] . "</p>";
                                        ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div> <!-- End of Columns 1 -->

                    <!-- Columns 2 PRODUCT -->
                    <div class="col">

                        <div class="card mb-3" style="max-width: 540px;">

                            <div class="row g-0">

                                <div class="col-md-4">
                                    <img src="../images/Product.png" class="img-fluid rounded-start" alt="...">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Products</h5>
                                        <?php
                                        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM product_tbl");
                                        $stmt->execute();
                                        $urow =  $stmt->fetch();

                                        echo "<p class='card-text'>" . $urow['numrows'] . "</p>";
                                        ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div> <!-- End of Columns 2 -->

                    <!-- Columns 3 USERS -->
                    <div class="col">

                        <div class="card mb-3" style="max-width: 540px;">

                            <div class="row g-0">

                                <div class="col-md-4">
                                    <img src="../images/Users.png" class="img-fluid rounded-start" alt="...">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Users</h5>
                                        <?php
                                        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM customer_tbl");
                                        $stmt->execute();
                                        $urow =  $stmt->fetch();

                                        echo "<p class='card-text'>" . $urow['numrows'] . "</p>";
                                        ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div> <!-- End of Columns 3 -->

                    <!-- Columns 4 PENDING -->
                    <div class="col">

                        <div class="card mb-3" style="max-width: 540px;">

                            <div class="row g-0">

                                <div class="col-md-4">
                                    <img src="../images/Pending.png" class="img-fluid rounded-start" alt="...">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Pending Orders</h5>
                                        <?php
                                        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM pendingorder_tbl");
                                        $stmt->execute();
                                        $urow =  $stmt->fetch();

                                        echo "<p class='card-text'>" . $urow['numrows'] . "</p>";
                                        ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div> <!-- End of Columns 4 -->

                </div> <!-- ------------------------------: END OF CARDS ------------------------------ -->





                <!-- ------------------------------ PENDING ORDERS ------------------------------ -->
                <div class="container-fluid" style="background-color: white;">

                    <br>

                    <h3> Pending Orders </h3> <br>

                    <table class="table">

                        <thead>

                            <tr>
                                <th scope="col"> Order No. </th>
                                <th scope="col"> Name </th>
                                <th scope="col"> Date </th>
                                <th scope="col"> View </th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($result)) {
                                foreach ($result as $row) { ?>

                                    <tr>

                                        <td data-label="Order No."> <?php echo $row['order_number']; ?> </td>
                                        <td data-label="Name"> <?php echo $row['customer_name']; ?> </td>
                                        <td data-label="Time"> <?php echo $row['date_created']; ?> </td>
                                        <td data-label="View">

                                            <a href="order_view.php?id=<?php echo $row['order_number'] ?>" class="btn btn-primary btn-sm">
                                                <span> <i class='bx bx-search-alt'></i>
                                            </a>

                                        </td>

                                    </tr>

                                    <!-- Include Modal php
                                <php include('view_modal.php'); ?> -->

                        </tbody>

                <?php }
                            } ?>

                    </table>

                <?php $pdo->close();
            } ?>

                </div> <br> <!-- ------------------------------ END OF PENDING ORDERS ------------------------------ -->





                <!-- ------------------------------ CHART ------------------------------ -->
                <div class="container-fluid" style="background-color: white;">
                    <br>
                    <h3>CHART</h3>

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
                        function updateChart() {
                            $.ajax({
                                url: 'fetch_chart_data.php',
                                method: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    // Get the chart data from the JSON response
                                    var chartData = data;

                                    // Create the chart using Chart.js
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var chart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: chartData.labels,
                                            datasets: [{
                                                label: 'Product Stock',
                                                data: chartData.values,
                                                backgroundColor: chartData.colors,
                                                borderColor: chartData.colors,
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
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
                <!-- ------------------------------ END OF CHART ------------------------------ -->





            </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->



        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>



    </body>

    </html>