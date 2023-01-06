<?php
include 'includes/session.php';

// Below is optional, remove if you have already connected to your database.
$mysqli = mysqli_connect('localhost', 'root', '', 'la_bvrgs');

// Get the total number of records from our table "students".
$total_pages = $mysqli->query('SELECT * FROM admin_tbl')->num_rows;

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 5;

if ($stmt = $mysqli->prepare('SELECT * FROM admin_tbl ORDER BY admin_id DESC LIMIT ?,?')) {
    // Calculate the page to get the results we need from our table.
    $calc_page = ($page - 1) * $num_results_on_page;
    $stmt->bind_param('ii', $calc_page, $num_results_on_page);
    $stmt->execute();
    // Get the results...
    $result = $stmt->get_result();
?>

    <!-- USER CSS DONE -->

    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table1.css">
    <link rel="stylesheet" type="text/css" href="css/tabbed_demo.css" />
    <link rel="stylesheet" type="text/css" href="css/tabbed_component.css" />

    <body>

        <!-- MISSING: SEARCH BAR AND DROPDOWN FILTER MENU -->

        <!-- Inner Content Code -->

        <div class='dashboard-app'>

            <header class='dashboard-toolbar'>

                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>

            </header>

            <div class='dashboard-content'>

                <div class='container'>

                    <div class="container-fluid" style="background-color: white;">

                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Administrator</li>
                            </ol>
                        </nav>

                        <h4> Administrator </h4>

                        <div id="tabs" class="tabs">
                            <nav>
                                <ul>
                                    <li><a href="user_admin.php"><i class='bx bxs-user-circle'></i><span>Admin</span></a>
                                    </li>
                                    <li><a href="user_regular.php"><i class='bx bxs-user'></i><span>Regular</span></a></li>
                                    <li><a href="user_guest.php"><i class='bx bxs-user-account'></i><span>Guest</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="container-fluid" style="background-color: white;">

                        <div class="container">

                            <!-- ADMIN TABLE -->

                            <a href="#add_admin" class="create-contact" data-bs-toggle="modal">Create Admin</a>

                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">Admin ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Date Updated</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while ($row = $result->fetch_assoc()) : ?>

                                        <tr>
                                            <td data-label="Admin ID">
                                                <?php echo $row['admin_id']; ?>
                                            </td>
                                            <td data-label="Username">
                                                <?php echo $row['admin_username']; ?>
                                            </td>
                                            <td data-label="Date Created">
                                                <?php echo $row['date_created'] ?>
                                            </td>
                                            <td data-label="Date Updated">
                                                <?php echo $row['date_updated'] ?>
                                            </td>
                                            <td data-label="">

                                                <!--<a href="#edit_<= $user['admin_id']; ?>"
                                                        class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                        <span> <i class='bx bxs-edit'></i> </span>
                                                    </a> -->

                                                <a href="#edit_<?php echo $row['admin_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                    <span> <i class='bx bxs-edit'></i> </span>
                                                </a>

                                                <a href="#delete_<?php echo $row['admin_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal">
                                                    <span> <i class='bx bxs-trash'></i> </span>
                                                </a>


                                            </td>

                                            <!-- Include Modal php -->
                                            <?php include('user_admin_modal.php'); ?>

                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                                <ul class="pagination">
                                    <?php if ($page > 1) : ?>
                                        <li class="prev"><a href="user_admin.php?page=<?php echo $page - 1 ?>">Prev</a></li>
                                    <?php endif; ?>

                                    <?php if ($page > 3) : ?>
                                        <li class="start"><a href="user_admin.php?page=1">1</a></li>
                                        <li class="dots">...</li>
                                    <?php endif; ?>

                                    <?php if ($page - 2 > 0) : ?><li class="page"><a href="user_admin.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                                    <?php if ($page - 1 > 0) : ?><li class="page"><a href="user_admin.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                                    <li class="currentpage"><a href="user_admin.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                                    <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="user_admin.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                                    <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="user_admin.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                                    <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                                        <li class="dots">...</li>
                                        <li class="end"><a href="user_admin.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                                    <?php endif; ?>

                                    <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                                        <li class="next"><a href="user_admin.php?page=<?php echo $page + 1 ?>">Next</a></li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>

                        <?php
                        $stmt->close();
                    }
                        ?>

                        </div> <!-- END OF CONTAINER FLUID -->

                    </div> <!-- END OF CONTAINER -->

                </div> <!-- END OF DASHBOARD CONTENT -->

            </div> <!-- END OF DASHBOARD APP DIV -->

        </div> <!-- END OF DASHBOARD SIDEBAR DIV -->

        <script src="js/tabbed.js"></script>
        <script>
            new CBPFWTabs(document.getElementById('tabs'));
        </script>
    </body>

    </html>