<?php include 'includes/session.php'; ?>

<?php

    $conn = $pdo->open();

    // Get all the categories from category table
    $sql = "SELECT * FROM productclass_tbl ORDER BY productClass_id ";
    $stmt = $conn->query($sql);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null; // Close the database connection

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

                            <h1> <b> Product Category </b> </h1>
                            <p> Add, Edit and Delete of Product Category </p>

                        </div>

                    </div>

                </div>

            </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->










            <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
            <section>

                <div class="container">

                    <a href="product.php" class="nav__link"> <i class='bx bx-arrow-back nav__icon'></i> Go back to Inventory </a> <br>

                
                    <!-- TABLE CONTAINER --> 
                    <div class="container-fluid" style="background-color: white;">
        
                        <div class="container"> <br>

                            <a href="#add_category" class="btn btn-light" data-bs-toggle="modal"><i class='bx bx-add-to-queue'></i> Add Category </a> <br><br>

                            <table>
                                
                                <thead>
                                    
                                    <tr>
                                        <th scope="col">Categories</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                
                                </thead>
                    
                                <tbody>
                                    
                                    <?php foreach ($row as $row) : ?>
                                
                                    <tr>

                                        <td data-label="Category"> <?php echo $row['product_class']; ?> </td>
                                        <td data-label="Date Created"> <?php echo $row['date_created']; ?> </td>
                                        <td data-label="Date Updated"> <?php echo $row['date_updated']; ?> </td>

                                        <td data-label="Options">
                                            <a href="#edit_<?php echo $row['productClass_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                <span><i class='bx bxs-edit'></i></span>
                                            </a>
                                            <a href="#delete_<?php echo $row['productClass_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal">
                                                <span><i class='bx bxs-trash'></i></span>
                                            </a>
                                        </td>

                                        <!-- Include Modal php -->
                                        <?php include('category_modal.php'); ?>

                                    </tr>

                                    <?php endforeach; ?>

                                </tbody>
                            
                            </table>
                            
                            <?php $stmt->closeCursor(); ?>

                        </div> <!-- END OF CONTAINER OF TABLE -->

                    </div> <!-- END OF CONTAINER FLUID OF TABLE -->
                
                </div> <!-- END OF CONTAINER -->

            </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>
        
    </body>

</html>