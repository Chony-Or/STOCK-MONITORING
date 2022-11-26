<?php include 'includes/session.php' ?>

<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['product_id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $conn->prepare('SELECT * FROM product_tbl WHERE product_id = ?');
    $stmt->execute([$_GET['product_id']]);
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
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/products.css">

<body>

    <section class="home-section">

        <div class="text">  <?= $product['product_name'] ?> </div>

        <div class="container-fluid" style="background-color: white;">

            <div class="product content-wrapper">
                <img src="../images/<?= $product['product_picture'] ?>" width="500" height="500" alt="<?= $product['product_name'] ?>">
                <div>
                    <h1 class="name">
                        <?= $product['product_name'] ?>
                    </h1>
                    <span class="price">
                        &dollar;<?= $product['product_price'] ?>
                    </span>
                    <div class="description">
                        <?= $product['product_stock'] ?>
                    </div>
                </div>
            </div>

        </div>

    </section>

</body>

</html>