<?php
include 'includes/session.php';

// Below is optional, remove if you have already connected to your database.
$mysqli = mysqli_connect('localhost', 'root', '', 'la_bvrgs');

// Get the total number of records from our table "students".
$total_pages = $mysqli->query('SELECT * FROM productclass_tbl')->num_rows;

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 5;

if ($stmt = $mysqli->prepare('SELECT * FROM productclass_tbl ORDER BY productClass_id LIMIT ?,?')) {
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

                    <h4> Product Categories </h4>

                    <div class="container-fluid" style="background-color: white;">

                        <!-- Button trigger modal -->
                        <a href="#add_category" class="btn btn-color" data-bs-toggle="modal"><i class='bx bx-add-to-queue'></i></a>

                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Categories</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row = $result->fetch_assoc()) : ?>

                                    <tr>
                                        <td data-label="Category">
                                            <?php echo $row['product_class']; ?>
                                        </td>

                                        <td data-label="Options">

                                            <a href="#edit_<?php echo $row['productClass_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                <span> <i class='bx bxs-edit'></i> </span>
                                            </a>

                                            <a href="#delete_<?php echo $row['productClass_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal">
                                                <span> <i class='bx bxs-trash'></i> </span>
                                            </a>


                                        </td>

                                        <!-- Include Modal php -->
                                        <?php include('category_modal.php'); ?>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                            <ul class="pagination">
                                <?php if ($page > 1) : ?>
                                    <li class="prev"><a href="category.php?page=<?php echo $page - 1 ?>">Prev</a></li>
                                <?php endif; ?>

                                <?php if ($page > 3) : ?>
                                    <li class="start"><a href="category..php">1</a></li>
                                    <li class="dots">...</li>
                                <?php endif; ?>

                                <?php if ($page - 2 > 0) : ?><li class="page"><a href="category.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                                <?php if ($page - 1 > 0) : ?><li class="page"><a href="category.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                                <li class="currentpage"><a href="category.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                                <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="admin.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                                <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="admin.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                                    <li class="dots">...</li>
                                    <li class="end"><a href="category.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                                    <li class="next"><a href="category.php?page=<?php echo $page + 1 ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>

                    <?php
                    $stmt->close();
                }
                    ?>

                    </div>

                </div>

            </div>

        </div>

        </div>
        <!-- partial -->

    </body>

    </html>