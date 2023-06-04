<?php include 'includes/session.php'; ?>

<?php

	// Initialize the search query variable
    $search_query = "";

    // Check if the search form is submitted
    if(isset($_GET['search']))
    {
        $search_query = $_GET['search'];

        // Modify the SQL query to include the search condition
        $stmt = $conn->prepare("SELECT * FROM customer_tbl WHERE customerClass_id = 1 AND
                                (customer_id LIKE :search_query OR 
                                customer_firstname LIKE :search_query OR 
                                customer_lastname LIKE :search_query OR 
                                customer_contactNo LIKE :search_query OR 
                                CONCAT(customer_houseno, ' ', customer_street, ' ', customer_city) LIKE :search_query OR 
                                customer_username LIKE :search_query OR 
                                DATE(date_created) = :search_date OR 
                                DATE(date_updated) = :search_date)
                                ORDER BY customer_id DESC");

        // Bind the search query parameter to the prepared statement
        $stmt->bindValue(':search_query', '%' . $search_query . '%');

        // Check if the search query is a valid date
        if (strtotime($search_query) !== false)
        {
            // Convert the search query to a date format
            $search_date = date('Y-m-d', strtotime($search_query));
            $stmt->bindValue(':search_date', $search_date);
        }
        else
        {
            // If the search query is not a valid date, bind a null value
            $stmt->bindValue(':search_date', null, PDO::PARAM_NULL);
        }

        $stmt->execute();
        $result = $stmt->fetchAll();
    }
    else
    {
        // If the search form is not submitted, fetch all regular customers
        $stmt = $conn->prepare("SELECT * FROM customer_tbl WHERE customerClass_id = 1 ORDER BY customer_id DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
    }

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>

    <!-- ================================================== BODY ================================================== -->
    <body>

        <!-- .................... MAIN BODY CONTENT .................... -->
        <main class="py-4">

            <!-- ------------------------------ Title and Search Bar ------------------------------ -->
            <section class="py-4 section-1">

                <div class="container py-1">

                    <div class="row text-center">

                        <div class="col-lg-12 mx-auto">

                            <h1> <b> Regular Customer </b> </h1>
                            <p> Add, Edit and Delete of data of the Regular Customer </p>

                            <div id="wrap">
                                
                                <form action="" autocomplete="on">
                                    <input id="search" name="search" type="text" placeholder="What're we looking for?" value="<?php echo $search_query; ?>">
                                    <input id="search_submit" value="Search" type="submit">
                                </form> <br><br><br>

                                <?php if (!empty($search_query)) { ?>
                                    <a href="user_regular.php" class="reset-search">Reset Search</a>
                                <?php } ?>

                            </div>

                        </div>

                    </div>

                </div>

            </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->










            <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
            <section>

                <div class="container">

                    <a href="index.php" class="nav__link"> <i class='bx bx-arrow-back nav__icon'></i> Go back to Dashboard </a> <br>

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
                                    <li><a href="user_regular.php"><i class='bx bxs-user'></i><span> Regular </span></a></li>
                                    <li class="tab-current"><a href="user_guest.php"><i class='bx bx-user' ></i><span> Guest </span></a></li>
                                    <li class="tab-current"><a href="user_admin.php"><i class='bx bxs-user-account' ></i><span> Admin </span></a></li>
                                </ul>
                            </nav> <br>

                        </div>

                    </div> <!-- END of Breadcrumbs and Tab Container -->
                
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
                                        <th scope="col">Contact</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Updated By</th>
                                        <th scope="col">Action</th>
                                    </tr>
                        
                                </thead> <!-- End of Table Headers -->
                        
                                <!-- Table Body -->
                                <tbody>
                        
                                    <!-- Nalimot ko purpose pero para sa database to pang fetch ata ng data -->
                                    <?php if (!empty($result)) { foreach ($result as $row) { ?>
                                    
                                    <tr>

                                        <!-- PHP Data Fetch to Display -->
                                        <td data-label="Customer ID"> <?php echo $row['customer_id']; ?> </td>
                                        <td data-label="Name"><?php echo $row['customer_firstname'] . ' ' . $row['customer_lastname']; ?> </td>
                                        <td data-label="Contact"> <?php echo $row['customer_contactNo']; ?> </td>
                                        <td data-label="Address"> <?php echo $row['customer_houseno'] . ' ' . $row['customer_street'] . ' ' . $row['customer_city']; ?> </td>
                                        <td data-label="Username"> <?php echo $row['customer_username']; ?> </td>
                                        <td data-label="Created By"> <?php echo date('F j, Y h:i A', strtotime($row['date_created'])); ?> </td>
                                        <td data-label="Updated By"> <?php echo $row['date_updated'] ?> </td>

                                        <td data-label="Action">
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

                                    <?php } } ?>
                        
                                </tbody> <!-- End of Table Body -->
                    
                            </table> <!-- END OF TABLE -->

                        </div> <!-- END OF CONTAINER OF TABLE -->

                    </div> <!-- END OF CONTAINER FLUID OF TABLE -->

            </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>
        
    </body>

</html>