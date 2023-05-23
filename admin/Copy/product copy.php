<?php include 'includes/session.php'; ?>

<?php

$category = isset($_GET['category']) ? $_GET['category'] : '';
$stmt = $conn->prepare("SELECT * FROM product_tbl JOIN productclass_tbl ON product_tbl.productClass_id = productclass_tbl.productClass_id WHERE productclass_tbl.product_class LIKE CONCAT('%', ?, '%') ORDER BY product_tbl.product_id ASC ");
$stmt->execute([$category]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of products
$total_products = $conn->query('SELECT * FROM product_tbl')->rowCount();
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>
<link rel="stylesheet" href="css/product.css"> <!-- Style for Product -->

<style>

    .gallery-item {
		width: 25%;
		padding: 10px;
	}
	.gallery-item img {
		max-width: 100%;
        height: auto;
        object-fit: contain;
	}
    @media (max-width: 768px) {
		.gallery-item {
			width: 50%;
		}
	}
	@media (max-width: 576px) {
		.gallery-item {
			width: 100%;
		}
	}

    .inv_img {
        max-width: 100%;
        height: 200px;
        object-fit: contain;
    }*/
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

                            <h1> Inventory </h1>
                            <p class="text-muted lead"> Add, Edit and Delete of data of the Regular Customer </p>

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

                <!-- PRODUCTS -->
                <div class="container-fluid">

                    <div class="container" style="background-color: white;">

                        <h5> Category </h5>

                                <?php
                                    $categories_stmt = $conn->prepare("SELECT DISTINCT product_class FROM productClass_tbl");
                                    $categories_stmt->execute();
                                    $categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>

                                <form action="" method="get">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="category" id="all_categories" value="" <?php if (!isset($_GET['category'])) echo 'checked' ?>>
                                        <label class="form-check-label" for="all_categories"> All categories </label>
                                    </div>
                                    
                                    <?php foreach ($categories as $category) : ?>
                                    
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="category" id="<?= $category['product_class'] ?>" value="<?= $category['product_class'] ?>" <?php if ($category['product_class'] == @$_GET['category']) echo 'checked' ?>>
                                            <label class="form-check-label" for="<?= $category['product_class'] ?>"> <?= $category['product_class'] ?> </label>
                                        </div>
                                    
                                    <?php endforeach; ?> <br>
                                    
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    
                                    <?php if (isset($_GET['category'])) : ?>
                                        <a href="product.php" class="btn btn-secondary">Reset Filter</a>
                                    <?php endif; ?>
                                </form>
                    
                    </div>

                    <div class="container">

                        <!-- PRODUCTS Image -->
                        <p> <?= $total_products ?> Products </p>
                        
                        <div class="container-fluid align-content-center">

                            <div class="products content-wrapper-gallery">

                                <div class="products-wrapper">
                                    
                                    <?php foreach ($products as $product) : ?>

                                        <a href="product_info.php?page=product_info&id=<?= $product['product_id'] ?>" class="product">
                                            <img class="gallery-item" src="./productsImages/<?= $product['product_picture'] ?>" alt="<?= $product['product_name'] ?>">
                                            <span class="name"><?= $product['product_name'] ?></span>
                                            <span class="price">&#8369;<?= $product['product_price'] ?></span>
                                        </a>

                                    <?php endforeach; ?>
                                
                                </div>

                                <?php include 'product_modal.php' ?>
                            
                            </div>
                        
                        </div>
                    
                    </div> <!-- End of PRODUCTS Image --> 

                </div>

            </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

        </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

        <?php include 'includes/javascripts.php'; ?>

        
    </body>

    </html>