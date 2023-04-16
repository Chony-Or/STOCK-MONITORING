<?php
    include 'includes/session.php';

    // Below is optional, remove if you have already connected to your database.
    $mysqli = mysqli_connect('localhost', 'root', '', 'la_bvrgs');

    // Check if a search query is submitted
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Get the total number of records from our table "students".
    $total_pages = $mysqli->query('SELECT * FROM admin_tbl')->num_rows;

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 5;

    // Prepare the SQL query with search query
    if ($stmt = $mysqli->prepare('SELECT * FROM admin_tbl WHERE admin_username LIKE ? ORDER BY admin_id DESC LIMIT ?,?'))
    {
        // Bind the search query and calculate the page to get the results we need from our table.
        $search_query = '%' . $search . '%';
        $calc_page = ($page - 1) * $num_results_on_page;
        $stmt->bind_param('sii', $search_query, $calc_page, $num_results_on_page);
        $stmt->execute();
    
        // Get the results...
        $result = $stmt->get_result();
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>

    <body>

        <!-- MAIN BODY CONTENT FOR REGULAR USER -->
        <main>

            <section>

                <div class="container"> <br>

                    <!-- Breadcrumbs and Tab Container -->
                    <div class="container-fluid" style="background-color: white;"> <br>
        
                        <!-- Divider -->
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Administrator</li>
                            </ol>
                        </nav>

                        <h4> Administrator </h4>

                        <!-- Tab -->
                        <div id="tabs" class="tabs">

                            <nav>
                                <ul>
                                    <li><a href="user_regular.php" class="icon-shop"><span> Regular </span></a></li>
                                    <li><a href="user_guest.php" class="icon-cup"><span> Guest </span></a></li>
                                    <li><a href="user_admin.php" class="icon-food"><span> Admin </span></a></li>
                                </ul>
                            </nav> <br>

                        </div>

                    </div> <!-- END of Breadcrumbs and Tab Container -->

                    <!-- 1 Row 2 Columns -->
                    <div class="row">

                        <!-- Search Container -->
                        <div class="col-sm-9 mb-3 mb-sm-0">

                            <div class="card card-container">

                                <div class="card-body">

                                    <div class="container text-left">

                                        <div class="row align-items-left">

                                            <div class="input-box">

                                                <i class="uil uil-search"></i>

                                                <form action="user_admin.php" method="GET">

                                                    <div class="form-group">

                                                        <input type="text" name="search" placeholder="Search products">
    
                                                    </div>
    
                                                    <button class="button" type="submit" value="Search">Search</button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Dropdown Container -->
                        <div class="col-sm-3">

                            <div class="card card-container">

                                <div class="card-body">

                                    <!-- Position Text to Right -->
                                    <div class="container text-end">

                                        <!-- Position Items to Right -->
                                        <div class="row align-items-end">

                                            <!-- Dropdown Menu -->
                                            <div class="dropdown">
                                                
                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Dropdown button
                                                </button>
                                                
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            
                                            </div>

                                        </div>
                                    
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div> <br>
                
                    <!-- TABLE CONTAINER --> 
                    <div class="container-fluid" style="background-color: white;">
        
                        <div class="container"> <br>

                            <!-- Add Button -->
                            <a href="#add_admin" class="create-contact" data-bs-toggle="modal"> Create New Admin </a>

                            <table>
                        
                                <!-- Table Headers -->
                                <thead>

                                    <tr>
                                        <th scope="col">Admin ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Date Updated</th>
                                        <th scope="col"></th>
                                    </tr>
                        
                                </thead> <!-- End of Table Headers -->
                        
                                <!-- Table Body -->
                                <tbody>
                        
                                    <!-- Nalimot ko purpose pero para sa database to pang fetch ata ng data -->
                                    <?php while ($row = $result->fetch_assoc()) : ?>

                                        <tr>

                                            <td data-label="Admin ID"><?php echo $row['admin_id']; ?> </td>
                                            <td data-label="Username"><?php echo $row['admin_username']; ?> </td>
                                            <td data-label="Date Created"><?php echo $row['date_created'] ?></td>
                                            <td data-label="Date Updated"><?php echo $row['date_updated'] ?></td>
                                            <td data-label="">
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
                            
                                    <?php endwhile; ?> <!-- Connected sa PHP sa pinaka mataas -->
                        
                                </tbody> <!-- End of Table Body -->
                    
                            </table> <!-- END OF TABLE -->

                            <!-- Pagination of the Table -->

                            <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                        
                            <ul class="pagination">
                                <?php if ($page > 1) : ?>
                                    <li class="prev">
                                        <a href="user_admin.php?page=<?php echo $page - 1 ?>">Prev</a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page > 3) : ?>
                                    <li class="start">
                                        <a href="user_admin.php?page=1">1</a>
                                    </li>
                                    <li class="dots">...</li>
                                <?php endif; ?>

                                <?php if ($page - 2 > 0) : ?>
                                    <li class="page">
                                        <a href="user_admin.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page - 1 > 0) : ?>
                                    <li class="page">
                                        <a href="user_admin.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a>
                                    </li>
                                <?php endif; ?>

                                <li class="currentpage">
                                    <a href="user_admin.php?page=<?php echo $page ?>"><?php echo $page ?></a>
                                </li>

                                <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?>
                                    <li class="page">
                                        <a href="user_admin.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?>
                                    <li class="page">
                                        <a href="user_admin.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                                    <li class="dots">...</li>
                                    <li class="end">
                                        <a href="user_admin.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>">
                                            <?php echo ceil($total_pages / $num_results_on_page) ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                                    <li class="next">
                                        <a href="user_admin.php?page=<?php echo $page + 1 ?>">Next</a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        
                            <?php endif; ?>

                            <?php $stmt->close(); } ?>

                        </div> <!-- END OF CONTAINER OF TABLE -->

                    </div> <!-- END OF CONTAINER FLUID OF TABLE -->
            
                </div> <!-- END OF SECTION CONTAINER -->

            </section> <!-- END OF SECTION -->

        </main> <!-- END OF MAIN -->

        <?php include 'includes/javascripts.php'; ?> <!-- CALL THE JAVASCRIPTS -->
    
    </body>

</html>