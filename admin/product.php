<?php include 'includes/session.php' ?>

<?php

// The amounts of products to show on each page
$num_products_on_each_page = 12;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int) $_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $conn->prepare('SELECT * FROM product_tbl ORDER BY date_created DESC LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of products
$total_products = $conn->query('SELECT * FROM product_tbl')->rowCount();
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>

<link rel="stylesheet" href="css/inventory.css">

<style>
    .inv_img {
        max-width: 100%;
        height: 200px;
        object-fit: contain;
    }
</style>

<body>

    <!-- MAIN BODY CONTENT -->
    <main>

        <section> <BR>

            <h4> INVENTORY </h4> <br>

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

                                        <form action="product.php" method="GET">

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

            <!-- PRODUCTS -->
            <div class="container-fluid" style="background-color: white;">

                <div class="products content-wrapper-gallery">

                    <a href="#add_product" class="btn btn-light" data-bs-toggle="modal"> <span> <i class='bx bxs-add-to-queue'></i> </span> Add Product</a>

                    <p>
                        <?= $total_products ?> Products
                    </p>
                    <div class="products-wrapper">
                        <?php foreach ($products as $product) : ?>
                            <a href="index.php?page=product_info&id=<?= $product['product_id'] ?>" class="product">

                                <img class="inv_img" src="./productsImages/<?= $product['product_picture'] ?>" alt="<?= $product['product_name'] ?>">
                                <span class="name">
                                    <?= $product['product_name'] ?>
                                </span>
                                <span class="price">
                                    &#8369;<?= $product['product_price'] ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <?php include 'product_addModal.php' ?>

                    <div class="buttons">
                        <?php if ($current_page > 1) : ?>
                            <a href="index.php?page=product&p=<?= $current_page - 1 ?>">Prev</a>
                        <?php endif; ?>
                        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)) : ?>
                            <a href="index.php?page=product&p=<?= $current_page + 1 ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </section>

    </main>

    <?php include 'includes/javascripts.php'; ?>

</body>

</html>