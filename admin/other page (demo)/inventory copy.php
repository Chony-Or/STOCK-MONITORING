<!-- Categories SQL -->
<?php
include 'includes/session.php'; ?>

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

        <section>

            <h4> INVENTORY </h4>

            <div class="row">

                <div class="col-sm-9 mb-3 mb-sm-0">

                    <div class="card card-container">

                        <div class="card-body">

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

                    </div>

                </div>

                <div class="col-sm-3">

                    <div class="card card-container">

                        <div class="card-body">

                        <?php

// Below is optional, remove if you have already connected to your database.
$mysqli = mysqli_connect('localhost', 'root', '', 'la_bvrgs');

// Get the total number of records from our table "students".
$total_pages = $mysqli->query('SELECT * FROM productclass_tbl')->num_rows;

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 5;

if ($stmt = $mysqli->prepare('SELECT * FROM productclass_tbl ORDER BY productClass_id LIMIT ?,?')) {
    // Calculate the page to get the results we need from our table.
    $calc_page = ($page - 1) * $num_results_on_page;
    $stmt->bind_param('ii', $calc_page, $num_results_on_page);
    $stmt->execute();
    // Get the results...
    $result = $stmt->get_result();
?>

                            <h5> Categories </h5>

                            <!-- Button trigger modal -->
                            <a href="#add_category" class="btn btn-color" data-bs-toggle="modal"><i class='bx bx-add-to-queue'></i></a>

                            <table>
                            <thead>
                                <tr>
                                    <th scope="col">Categories</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row = $result->fetch_assoc()) : ?>

                                    <tr>
                                        <td data-label="Category">
                                            <?php echo $row['product_class']; ?>
                                        </td>

                                        <td data-label="Options">

                                            <a href="#edit_<?php echo $row['productClass_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                <span> <i class='bx bxs-edit'></i> </span>
                                            </a>

                                            <a href="#delete_<?php echo $row['productClass_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal">
                                                <span> <i class='bx bxs-trash'></i> </span>
                                            </a>


                                        </td>

                                        <!-- Include Modal php -->
                                        <?php include('category_modal.php'); ?>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                            <ul class="pagination">
                                <?php if ($page > 1) : ?>
                                    <li class="prev"><a href="category.php?page=<?php echo $page - 1 ?>">Prev</a></li>
                                <?php endif; ?>

                                <?php if ($page > 3) : ?>
                                    <li class="start"><a href="category..php">1</a></li>
                                    <li class="dots">...</li>
                                <?php endif; ?>

                                <?php if ($page - 2 > 0) : ?><li class="page"><a href="category.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                                <?php if ($page - 1 > 0) : ?><li class="page"><a href="category.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                                <li class="currentpage"><a href="category.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                                <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="admin.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                                <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="admin.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                                    <li class="dots">...</li>
                                    <li class="end"><a href="category.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                                <?php endif; ?>

                                <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                                    <li class="next"><a href="category.php?page=<?php echo $page + 1 ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>

                    <?php
                    $stmt->close();
                }
                    ?>

                        </div>

                    </div>

                </div>

            </div>

            <br>

        </section>

    </main>

    <?php include 'includes/javascripts.php'; ?>
    
</body>

</html>