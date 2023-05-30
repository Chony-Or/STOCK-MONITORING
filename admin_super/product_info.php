<?php include 'includes/session.php'; ?>

<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $conn->prepare('SELECT * FROM product_tbl WHERE product_id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>

<link rel="stylesheet" href="css/product_style.css"> <!-- Style for Product -->

    <!-- ================================================== BODY ================================================== -->
    <body>

        <!-- .................... MAIN BODY CONTENT .................... -->
        <main>

            <!-- ------------------------------ Title and Search Bar ------------------------------ -->
            <section class="py-4 section-1">

                <div class="container py-1">

                    <div class="row text-center">
                
                        <div class="col-lg-12 mx-auto">

                            <h1> Product Information </h1>
                            <p class="text-muted lead"> Edit or Delete Product Information </p>

                        </div>

                    </div>

                </div>

                <a href="product.php" class="btn btn-light"><i class='bx bx-arrow-back' ></i> Back to Products </a>
                
            </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->


            <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
            <section>

                <div class="card mb-3" style="max-width: 100%;">
                
                    <div class="row g-0">
                    
                        <div class="col-md-5 text-center"><br>
                            <img src="./productsImages/<?= $product['product_picture'] ?>" class="img-fluid rounded-start product-image" alt="<?= $product['product_name'] ?>">
                        </div>

                        <div class="col-md-7 col align-self-center">
                        
                            <div class="card-body">
                        
                                <h1 class="card-title"><?= $product['product_name'] ?></h1> <br>
                                <p class="card-text"> Price: &#8369;<?= $product['product_price'] ?></p>
                                <p class="card-text"> Stock: <?= $product['product_stock'] ?></p>
                        
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="#edit_<?= $product['product_id'] ?>" class="btn btn-primary" data-bs-toggle="modal"><span> <i class='bx bxs-edit'></i> </span> Edit</a>
                            <a href="#delete_<?= $product['product_id'] ?>" class="btn btn-danger" data-bs-toggle="modal"> <span> <i class='bx bxs-trash'></i> </span> Delete</a>
                        </div>

                    </div>

                </div>

            </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

            <?php include 'product_modal.php' ?>

        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>

        
    </body>

    </html>