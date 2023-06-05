<?php include 'includes/session.php'; ?>

<?php
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';

    // Prepare the base SQL query
    $sql = "SELECT * FROM product_tbl JOIN productclass_tbl ON product_tbl.productClass_id = productclass_tbl.productClass_id";

    // Prepare the search condition
    $searchCondition = '';
    $searchParams = [];

    if (!empty($search_query))
    {
        $searchCondition = " WHERE ";
        $searchCondition .= "product_tbl.product_id LIKE CONCAT('%', :search_query, '%') OR ";
        $searchCondition .= "productclass_tbl.productClass_id LIKE CONCAT('%', :search_query, '%') OR ";
        $searchCondition .= "product_tbl.product_price LIKE CONCAT('%', :search_query, '%') OR ";
        $searchCondition .= "product_tbl.product_name LIKE CONCAT('%', :search_query, '%') OR ";
        $searchCondition .= "product_tbl.product_stock LIKE CONCAT('%', :search_query, '%') OR ";
        $searchCondition .= "product_tbl.product_details LIKE CONCAT('%', :search_query, '%') OR ";
        $searchCondition .= "product_tbl.product_code LIKE CONCAT('%', :search_query, '%') OR ";
        $searchCondition .= "product_tbl.date_created LIKE CONCAT('%', :search_query, '%') OR ";
        $searchCondition .= "product_tbl.date_updated LIKE CONCAT('%', :search_query, '%')";

        // Add search query parameter
        $searchParams = [':search_query' => $search_query];
    }

    // Prepare the final SQL query
    $stmt = $conn->prepare($sql . $searchCondition);
    $stmt->execute($searchParams);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get the total number of products
    $total_products = $stmt->rowCount();
?>


<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>

<link rel="stylesheet" href="css/product.css"> <!-- Style for Product -->

<style>

    .product-info
    {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-info .price
    {
        margin-top: auto;
    }

    .product-image
    {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 250px; /* set a fixed height */
    }

    .product-image img
    {
        max-width: 100%;
        height: 200px; /* set a fixed width for the image */
    }

    .product-info
    {
        margin-top: auto; /* Push the product name and price to the bottom of the container */
        text-align: center; /* Center the product name and price */
    }

</style>

    <!-- ================================================== BODY ================================================== -->
    <body>

        <!-- .................... MAIN BODY CONTENT .................... -->
        <main>

            <!-- ------------------------------ Title and Search Bar ------------------------------ -->
            <section class="py-4 section-1">

                <div class="container py-1">

                    <div class="row text-center">

                        <div class="col-lg-12 mx-auto">

                            <h1> <b> Inventory </b> </h1>
                            <p> Add, Edit and Delete of data of the Regular Customer </p>

                            <div id="wrap">
                                
                                <form action="" autocomplete="on">
                                    <input id="search" name="search" type="text" placeholder="What're we looking for?" value="<?php echo $search_query; ?>">
                                    <input id="search_submit" value="Search" type="submit">
                                </form> <br><br><br>

                                <?php if (!empty($search_query)) { ?>
                                    <a href="product.php" class="reset-search">Reset Search</a>
                                <?php } ?>

                            </div>

                        </div>

                    </div>

                </div>

            </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->




            <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
            <section>

                <!-- PRODUCTS -->
                <div class="container-fluid">

                    <div class="container" style="background-color: white;"> <br>

                        <h5> Category </h5> <br>

                        <?php
                            $categories_stmt = $conn->prepare("SELECT DISTINCT product_class FROM productClass_tbl");
                            $categories_stmt->execute();
                            $categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <form action="" method="get" class="text-center">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" id="all_categories" value="" <?php if (!isset($_GET['category'])) echo 'checked' ?>>
                            <label class="form-check-label" for="all_categories"> All categories </label>
                        </div>

                        <?php foreach ($categories as $category) : ?>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" id="<?= $category['product_class'] ?>" value="<?= $category['product_class'] ?>" <?php if ($category['product_class'] == @$_GET['category']) echo 'checked' ?>>
                            <label class="form-check-label" for="<?= $category['product_class'] ?>"> <?= $category['product_class'] ?> </label>
                        </div>

                        <?php endforeach; ?>

                        <br><br>

                        <button type="submit" class="btn btn-light">Filter</button>

                        <?php if (isset($_GET['category'])) : ?>
                            <a href="product.php" class="btn btn-light">Reset Filter</a>
                        <?php endif; ?>

                        </form> <br>

                        <!-- Add Button -->
                        <a href="category.php" class="create-contact"> View Product Categories </a> <br>

                    </div>

                    <div class="container" style="background-color: white;">

                        <!-- Products -->
                        <div class="container my-5"> <br>

                            <a href="#add_product" class="btn btn-light" data-bs-toggle="modal"> <span> <i class='bx bxs-add-to-queue'></i> </span> Add Product</a>

                            <p class="text-center"> <b> Total Products: <?= $total_products ?> </b> </p> <br>

                            <div class="row">
                            
                                <?php foreach ($products as $product) : ?>
                            
                                    <div class="col-md-3 col-sm-6 mb-4">
                                    
                                        <a href="product_info.php?page=product_info&id=<?= $product['product_id'] ?>" class="product">
                                        
                                            <div class="product-image">

                                                <img class="img-fluid" src="../productsImages/<?= $product['product_picture'] ?>" alt="<?= $product['product_name'] ?>">
            
                                                <div class="product-info">
                                                    <span class="name"><?= $product['product_name'] ?></span>
                                                    <span class="price">&#8369;<?= $product['product_price'] ?></span>
                                                </div>

                                            </div>

                                        </a>

                                    </div>
                            
                                <?php endforeach; ?>
  
                            </div>

                            <?php include 'product_modal.php' ?>

                        </div>

                    </div>

                </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

            <!-- Include the notification.js file -->
            <script src="js/notification.js"></script>

        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>

    </body>

</html>