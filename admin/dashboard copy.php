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
    <?php include 'includes/sidebar.php'; ?>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table1.css">

    <body>

        <!-- Inner Content Code -->

        <div class='dashboard-app'>

            <header class='dashboard-toolbar'>

                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>

            </header>

            <div class='dashboard-content'>

                <div class='container'>

                    <h4> DASHBOARD </h4>

                    <div class="container-fluid" style="background-color: white;">
                        <h5> Overview </h5>

                        <div class="row">

                            <div class="col">

                                <div class="list-group">

                                    <label class="list-group-item">
                                        <i class='bx bx-cart-add'></i>
                                        No. Purchase
                                    </label>

                                    <label class="list-group-item">
                                        <i class='bx bx-purchase-tag-alt'></i>
                                        Total Cost
                                    </label>

                                </div>

                            </div>

                            <div class="col">

                                <div class="list-group">

                                    <label class="list-group-item">
                                        <i class='bx bxs-message-square-x'></i>
                                        Cancel Order
                                    </label>

                                    <label class="list-group-item">
                                        <i class='bx bx-arrow-back'></i>
                                        Return
                                    </label>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="container-fluid" style="background-color: white;">
                        <h5>Pending Orders </h5>

                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Order No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Accept/Cancel</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td data-label="Order No."> <?php echo $row['order_number']; ?> </td>
                                        <td data-label="Name"> <?php echo $row['customer_name']; ?> </td>
                                        <td data-label="Time"> <?php echo $row['date_created']; ?> </td>
                                        <td data-label="View">

                                            <a href="#view_<?php echo $row['pendingOrder_id']; ?>" class="btn btn-primary btn-sm" data-bs-toggle="modal">
                                                <span> <i class='bx bx-search-alt'></i>
                                            </a>

                                        </td>

                                        <td data-label="Accept/Cancel">

                                            <a href="#edit_<?php echo $row['pendingOrder_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                <span> <i class='bx bx-check'></i>
                                            </a>

                                            <a href="#delete_<?php echo $row['pendingOrder_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Default tooltip" data-bs-toggle="modal">
                                                <span> <i class='bx bx-x'></i>
                                            </a>

                                        </td>

                                    </tr>

                                    <!-- Include Modal php -->
                                    <?php include('view_modal.php'); ?>
                            </tbody>
                        <?php endwhile; ?>
                        </table>

                        <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                            <ul class="pagination">
                                <?php if ($page > 1) : ?>
                                    <li class="prev"><a href="user_regular.php?page=<?php echo $page - 1 ?>">Prev</a></li>
                                <?php endif; ?>

                                <?php if ($page > 3) : ?>
                                    <li class="start"><a href="user_regular.php?page=1">1</a></li>
                                    <li class="dots">...</li>
                                <?php endif; ?>

                                <?php if ($page - 2 > 0) : ?><li class="page"><a href="user_regular.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                                <?php if ($page - 1 > 0) : ?><li class="page"><a href="user_regular.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                                <li class="currentpage"><a href="user_regular.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                                <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="user_regular.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                                <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="user_regular.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                                    <li class="dots">...</li>
                                    <li class="end"><a href="user_regular.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                                    <li class="next"><a href="user_regular.php?page=<?php echo $page + 1 ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>

                    <?php
                    $stmt->close();
                }
                    ?>


                    </div>

                    <div class="container-fluid" style="background-color: white;">
                        <h5> Graph </h5>


                    </div>


                </div>

            </div>

        </div>

        </div>
        <!-- partial -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>

    </body>

    <!--<div class='card'>
<div class='card-header'> <h1>Welcome back Ha</h1> </div>
<div class='card-body'> <p>Your account type is: Administrator </p> </div>
</div> -->

    </html>