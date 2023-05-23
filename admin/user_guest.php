<?php include 'includes/session.php'; ?>

<?php	
	$stmt = $conn->prepare("SELECT * FROM customer_tbl WHERE customerClass_id=2 ORDER BY customer_id DESC");
	$stmt->execute();
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

                            <h1> Guest Customer </h1>
                            <p class="text-muted lead"> Add, Edit and Delete of data of the Guest Customer </p>

                            <div id="wrap">
                                
                                <form action="" autocomplete="on">
                                    <input id="search" name="search" type="text" placeholder="What're we looking for ?" value="<?php echo $search_query; ?>"><input id="search_submit" value="Rechercher" type="submit">
                                </form>

                            </div>

                        </div>

                    </div>

                </div>
                
            </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->





            <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
            <section>

                <div class="container">

                    <!-- Breadcrumbs and Tab Container -->
                    <div class="container-fluid" style="background-color: white;"> <br>
        
                        <!-- Divider -->
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Guest</li>
                            </ol>
                        </nav>

                        <h4> Guest </h4>

                        <!-- Tab -->
                        <div id="tabs" class="tabs">

                            <nav>
                                <ul>
                                    <li><a href="user_regular.php" class="icon-shop"><span> Regular </span></a></li>
                                    <li class="tab-current"><a href="user_guest.php" class="icon-cup"><span> Guest </span></a></li>
                                    <li><a href="user_admin.php" class="icon-food"><span> Admin </span></a></li>
                                </ul>
                            </nav> <br>

                        </div>

                    </div> <!-- END of Breadcrumbs and Tab Container -->
                
                    <!-- TABLE CONTAINER --> 
                    <div class="container-fluid" style="background-color: white;">
        
                        <div class="container"> <br>

                            <!-- Add Button -->
                            <a href="#add_guest" class="create-contact" data-bs-toggle="modal"> Add Guest Customer </a>

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
                                    <?php if (!empty($result)) {
                                        foreach ($result as $row) { ?>

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
                                            <?php include('user_guest_modal.php'); ?>

                                        </tr>

                                        <?php }
                                        } ?>
                        
                                </tbody> <!-- End of Table Body -->
                    
                            </table> <!-- END OF TABLE -->

                        </div> <!-- END OF CONTAINER OF TABLE -->

                    </div> <!-- END OF CONTAINER FLUID OF TABLE -->
            
                </div> <!-- END OF SECTION CONTAINER -->

            </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

        </main> <br> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>

        
    </body>

    </html>