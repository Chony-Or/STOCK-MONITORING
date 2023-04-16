<?php

    include 'includes/session.php';

    // Below is optional, remove if you have already connected to your database.
    $mysqli = mysqli_connect('localhost', 'root', '', 'la_bvrgs');

    // Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

    // Number of results to show on each page.
    $num_results_on_page = 5;

    // Check if search keyword is submitted
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Get the total number of records from our table "students".
    if (!empty($search)) {
        $stmt = $mysqli->prepare("SELECT COUNT(*) as total FROM customer_tbl WHERE customerClass_id=1 AND (customer_id LIKE ? OR customer_name LIKE ? OR customer_address LIKE ? OR customer_contactNo LIKE ?)");
        $search_param = "%{$search}%";
        $stmt->bind_param('ssss', $search_param, $search_param, $search_param, $search_param);
        $stmt->execute();
        $result = $stmt->get_result();
        $total_pages = $result->fetch_assoc()['total'];
    } else {
        $total_pages = $mysqli->query('SELECT * FROM customer_tbl')->num_rows;
    }

    if ($stmt = $mysqli->prepare('SELECT * FROM customer_tbl WHERE customerClass_id=1 AND (customer_id LIKE ? OR customer_name LIKE ? OR customer_address LIKE ? OR customer_contactNo LIKE ?) ORDER BY customer_id DESC LIMIT ?,?'))
    {
        // Calculate the page to get the results we need from our table.
        $calc_page = ($page - 1) * $num_results_on_page;
        $search_param = "%{$search}%";
        $stmt->bind_param('ssssii', $search_param, $search_param, $search_param, $search_param, $calc_page, $num_results_on_page);
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
                                <li class="breadcrumb-item" aria-current="page">Regular</li>
                            </ol>
                        </nav>

                        <h4> Regular Customer </h4>

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

                                                <form action="user_regular.php" method="GET">

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
                            <a href="#add_regular" class="create-contact" data-bs-toggle="modal"> Add Regular Customer </a>

                            <table>
                        
                                <!-- Table Headers -->
                                <thead>

                                    <tr>
                                        <th scope="col">Customer ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Updated By</th>
                                        <th scope="col"></th>
                                    </tr>
                        
                                </thead> <!-- End of Table Headers -->
                        
                                <!-- Table Body -->
                                <tbody>
                        
                                    <!-- Nalimot ko purpose pero para sa database to pang fetch ata ng data -->
                                    <?php while ($row = $result->fetch_assoc()) : ?>

                                    <tr>

                                        <!-- PHP Data Fetch to Display -->
                                        <td data-label="Customer ID"> <?php echo $row['customer_id']; ?> </td>
                                        <td data-label="Name"> <?php echo $row['customer_name']; ?> </td>
                                        <td data-label="Address"> <?php echo $row['customer_address']; ?> </td>
                                        <td data-label="Contact"> <?php echo $row['customer_contactNo']; ?> </td>
                                        <td data-label="Created By"> <?php echo $row['date_created'] ?> </td>
                                        <td data-label="Updated By"> <?php echo $row['date_updated'] ?> </td>
                                        <td data-label="">
                                            <a href="#edit_<?php echo $row['customer_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                <span> <i class='bx bxs-edit'></i> </span>
                                            </a>
                                            <a href="#delete_<?php echo $row['customer_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal">
                                                <span> <i class='bx bxs-trash'></i> </span>
                                            </a>
                                        </td>

                                        <!-- Include Modal php -->
                                        <?php include('user_regular_modal.php'); ?>

                                    </tr>
                            
                                    <?php endwhile; ?> <!-- Connected sa PHP sa pinaka mataas -->
                        
                                </tbody> <!-- End of Table Body -->
                    
                            </table> <!-- END OF TABLE -->

                            <!-- Pagination of the Table -->

                            <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                        
                            <ul class="pagination">
                                <?php if ($page > 1) : ?>
                                    <li class="prev">
                                        <a href="user_regular.php?page=<?php echo $page - 1 ?>">Prev</a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page > 3) : ?>
                                    <li class="start">
                                        <a href="user_regular.php?page=1">1</a>
                                    </li>
                                    <li class="dots">...</li>
                                <?php endif; ?>

                                <?php if ($page - 2 > 0) : ?>
                                    <li class="page">
                                        <a href="user_regular.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page - 1 > 0) : ?>
                                    <li class="page">
                                        <a href="user_regular.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a>
                                    </li>
                                <?php endif; ?>

                                <li class="currentpage">
                                    <a href="user_regular.php?page=<?php echo $page ?>"><?php echo $page ?></a>
                                </li>

                                <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?>
                                    <li class="page">
                                        <a href="user_regular.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?>
                                    <li class="page">
                                        <a href="user_regular.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                                    <li class="dots">...</li>
                                    <li class="end">
                                        <a href="user_regular.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>">
                                            <?php echo ceil($total_pages / $num_results_on_page) ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                                    <li class="next">
                                        <a href="user_regular.php?page=<?php echo $page + 1 ?>">Next</a>
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