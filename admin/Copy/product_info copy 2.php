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

<link rel="stylesheet" href="css/inventory.css">

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
                
            </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->

                <div class="container-fluid" style="background-color: white;">

                            <div class="row">
                                <div class="col">
                                    <img src="./productsImages/<?= $product['product_picture'] ?>" class="imgclass" alt="<?= $product['product_name'] ?>">
                                </div>

                                <div class="col col1">
                                    <div>
                                        <h1 class="name">
                                            <?= $product['product_name'] ?>
                                        </h1>
                                        <span class="price"> Price:
                                            &#8369;<?= $product['product_price'] ?>
                                        </span>
                                        <div class="description"> Stock:
                                            <?= $product['product_stock'] ?>
                                        </div>

                                        <a href="index.php?page=inventory/delete.php?id=<?= $product['product_id'] ?>" class="trash" title="Delete Image"><i class='bx bxs-trash-alt'></i></a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        </div>


            <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
            <section>

            </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>

        
    </body>

    </html>