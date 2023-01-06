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
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/inventory.css">

<style>
    .imgclass {
        max-width: 100%;
        height: 450px;
        object-fit: cover;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<body>

    <!-- Inner Content Code -->

    <div class='dashboard-app'>

        <header class='dashboard-toolbar'>

            <a href="#!" class="menu-toggle">
                <i class="fas fa-bars"></i>
            </a>

        </header>

        <div class='dashboard-content'>

            <div class='container'>

                <section class="home-section">

                    <main>

                        <div class="text"> Inventory </div>
                        <!-- Button trigger modal -->

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
                    </main>
                </section>

            </div>

        </div>

    </div>

    </div>
    <!-- partial -->

</body>

</html>