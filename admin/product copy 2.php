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


<?php

function paginate($total_items, $items_per_page, $current_page, $url)
{
    $total_pages = ceil($total_items / $items_per_page);

    $pagination = '<nav aria-label="Pagination"><ul class="pagination">';
    $pagination .= '<li class="page-item"><a class="page-link" href="' . $url . '&p=1">First</a></li>';

    for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $total_pages); $i++) {
        if ($i == $current_page) {
            $pagination .= '<li class="page-item active"><a class="page-link" href="' . $url . '&p=' . $i . '">' . $i . '</a></li>';
        } else {
            $pagination .= '<li class="page-item"><a class="page-link" href="' . $url . '&p=' . $i . '">' . $i . '</a></li>';
        }
    }

    $pagination .= '<li class="page-item"><a class="page-link" href="' . $url . '&p=' . $total_pages . '">Last</a></li>';
    $pagination .= '</ul></nav>';

    return $pagination;
}

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

                    <div class="input-box">

                        <i class="uil uil-search"></i>
                        <input type="text" placeholder="Search here..." />
                        <button class="button">Search</button>

                    </div>

                </div>

                <!-- Dropdown Container -->
                <div class="col-sm-3">

                    <!-- Position Text to Right -->
                    <div class="container text-end">
                        
                        <!-- Position Items to Right -->
                        <div class="row align-items-end">

                            <!-- Dropdown Menu -->
                            <div class="dropdown">

                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown link
                                </a>

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

            <br>

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
<?= paginate($total_products, $num_products_on_each_page, $current_page, 'index.php?page=products') ?>


<?php include 'product_addModal.php' ?>

</div>

            </div>

        </section>

    </main>

    <?php include 'includes/javascripts.php'; ?>
    
</body>

</html>