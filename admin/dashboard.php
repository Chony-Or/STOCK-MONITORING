<?php
include 'includes/session.php';

// Below is optional, remove if you have already connected to your database.
$mysqli = mysqli_connect('localhost', 'root', '', 'la_bvrgs');

// Get the total number of records from our table "students".
$total_pages = $mysqli->query('SELECT * FROM pendingorder_tbl')->num_rows;

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 5;

if ($stmt = $mysqli->prepare('SELECT *, pendingorder_tbl.pendingOrder_id AS pending FROM pendingorder_tbl LEFT JOIN customer_tbl ON customer_tbl.customer_id=pendingorder_tbl.customer_id GROUP BY order_number ORDER BY pendingorder_id DESC LIMIT ?,?')) {
    // Calculate the page to get the results we need from our table.
    $calc_page = ($page - 1) * $num_results_on_page;
    $stmt->bind_param('ii', $calc_page, $num_results_on_page);
    $stmt->execute();
    // Get the results...
    $result = $stmt->get_result();
?>

    <?php include 'includes/header.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <body>

        <!-- MAIN BODY CONTENT -->
        <main>

            <section>

                <h4> DASHBOARD </h4>

                <div class="row">

                    <div class="col-sm-6 mb-3 mb-sm-0">

                        <div class="card card-container">

                            <div class="card-body">

                                <div class="container text-center">

                                    <div class="row align-items-center">

                                        <div class="col">
                                            <div class="list-group">

                                                <label class="list-group-item">
                                                    <i class='bx bx-cart-add'></i>
                                                    No. Purchase

                                                    <?php
                                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transachistory_tbl");
                                                    $stmt->execute();
                                                    $urow =  $stmt->fetch();

                                                    echo "<h3>" . $urow['numrows'] . "</h3>";
                                                    ?>
                                                </label>

                                                <label class="list-group-item">
                                                    <i class='bx bx-purchase-tag-alt'></i>
                                                    Total Products

                                                    <?php
                                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM product_tbl");
                                                    $stmt->execute();
                                                    $urow =  $stmt->fetch();

                                                    echo "<h3>" . $urow['numrows'] . "</h3>";
                                                    ?>
                                                </label>

                                            </div>


                                        </div>

                                        <div class="col">

                                            <div class="list-group">

                                                <label class="list-group-item">
                                                    <i class='bx bxs-message-square-x'></i>
                                                    Total Users

                                                    <?php
                                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM customer_tbl");
                                                    $stmt->execute();
                                                    $urow =  $stmt->fetch();

                                                    echo "<h3>" . $urow['numrows'] . "</h3>";
                                                    ?>
                                                </label>

                                                <label class="list-group-item">
                                                    <i class='bx bx-arrow-back'></i>
                                                    Pending Orders

                                                    <?php
                                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM pendingorder_tbl");
                                                    $stmt->execute();
                                                    $urow =  $stmt->fetch();

                                                    echo "<h3>" . $urow['numrows'] . "</h3>";
                                                    ?>
                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div class="card card-container">

                            <div class="card-body">

                                <h5> Pending Orders </h5>

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
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td data-label="Order No."> <?php echo $row['order_number']; ?> </td>
                                                <td data-label="Name"> <?php echo $row['customer_name']; ?> </td>
                                                <td data-label="Time"> <?php echo $row['date_created']; ?> </td>
                                                <td data-label="View">

                                                    <a href="index.php?page=view_page&id=<?php echo $row['order_number'] ?>" class="btn btn-primary btn-sm">
                                                        <span> <i class='bx bx-search-alt'></i>

                                                </td>

                                            </tr>

                                            <!-- Include Modal php
                                    <php include('view_modal.php'); ?> -->

                                    </tbody>
                                <?php endwhile; ?>
                                </table>

                                <!-- Pagination of the Table -->

                            <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                        
                            <ul class="pagination">
                                <?php if ($page > 1) : ?>
                                    <li class="prev">
                                        <a href="dashboard.php?page=<?php echo $page - 1 ?>">Prev</a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page > 3) : ?>
                                    <li class="start">
                                        <a href="dashboard.php?page=1">1</a>
                                    </li>
                                    <li class="dots">...</li>
                                <?php endif; ?>

                                <?php if ($page - 2 > 0) : ?>
                                    <li class="page">
                                        <a href="dashboard.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page - 1 > 0) : ?>
                                    <li class="page">
                                        <a href="dashboard.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a>
                                    </li>
                                <?php endif; ?>

                                <li class="currentpage">
                                    <a href="dashboard.php?page=<?php echo $page ?>"><?php echo $page ?></a>
                                </li>

                                <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?>
                                    <li class="page">
                                        <a href="dashboard.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?>
                                    <li class="page">
                                        <a href="dashboard.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                                    <li class="dots">...</li>
                                    <li class="end">
                                        <a href="dashboard.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>">
                                            <?php echo ceil($total_pages / $num_results_on_page) ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                                    <li class="next">
                                        <a href="dashboard.php?page=<?php echo $page + 1 ?>">Next</a>
                                    </li>
                                <?php endif; ?>

                            </ul>

                            <?php endif; ?>

                            <?php $pdo->close();
                        } ?>



                            </div>

                        </div>

                    </div>

                </div>

                <br>

                <!-- CHART -->
                <div class="container-fluid" style="background-color: white;">

                    <h3> CHART </h3>

                    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>

                </div>

            </section>

        </main>

        <?php include 'includes/javascripts.php'; ?>

        <script src="js/chart.js"></script> <!-- Chart Javascript -->
        <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        
    </body>

    </html>