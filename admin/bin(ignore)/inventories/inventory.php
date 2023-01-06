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
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/inventory.css">

<body>

    <section class="home-section">

    <main>

        <div class="text"> Inventory </div>

        <div class="container-fluid" style="background-color: white;">

            <div class="products content-wrapper-gallery">
                <p>
                    <?= $total_products ?> Products
                </p>
                <div class="products-wrapper">
                    <?php foreach ($products as $product): ?>
                    <a href="index.php?page=inventory/inventory_modal&id=<?= $product['product_id'] ?>" class="product">
                        <img src="../images/products/<?= $product['product_picture'] ?>" width="200" height="200" alt="<?= $product['product_name'] ?>">
                        <span class="name">
                            <?= $product['product_name'] ?>
                        </span>
                        <span class="price">
                        &#8369;<?= $product['product_price'] ?>
                        </span>
                    </a>
                    <?php endforeach; ?>
                </div>
                <div class="buttons">
                    <?php if ($current_page > 1): ?>
                    <a href="index.php?page=inventory/inventory&p=<?= $current_page - 1 ?>">Prev</a>
                    <?php endif; ?>
                    <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
                    <a href="index.php?page=inventory/inventory&p=<?= $current_page + 1 ?>">Next</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
                    </main>
    </section>
</body>

</html>