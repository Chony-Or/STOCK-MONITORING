<?php include 'includes/session.php' ?>

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
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/inventory.css">

<body>

    <section class="home-section">

        <main>

            <div class="text">
                Inventory
            </div>

            <div class="container-fluid" style="background-color: white;">

                <a href="index.php?page=inventory/inventory">
                    <i class='bx bx-arrow-back'></i>
                    <span class="links_name"> Back</span>
                </a>

                <div class="row">
                    <div class="col">
                        <img src="../images/products/<?= $product['product_picture'] ?>" width="500" height="500"
                            alt="<?= $product['product_name'] ?>">
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

                            <a href="index.php?page=inventory/delete.php?id=<?=$product['product_id']?>" class="trash" title="Delete Image"><i class='bx bxs-trash-alt'></i></a>
                        </div>
                    </div>

                </div>

            </div>

        </main>

    </section>

</body>

</html>