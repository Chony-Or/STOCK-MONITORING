<?php
include 'includes/session.php';

// Fetch products with low stock
$stmt = $conn->prepare('SELECT * FROM product_tbl WHERE product_stock < 10');
$stmt->execute();
$lowStockProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
include 'includes/menubar.php';
?>

<!-- ================================================== BODY ================================================== -->
<body>

    <!-- .................... MAIN BODY CONTENT .................... -->
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card mt-5">
                        <div class="card-body text-center">
                            <h1 class="card-title">Notification</h1>
                            <p class="text-muted lead">Low stock alert: Some products have stock below 10.</p>
                            <hr>
                            <h4 class="mb-4">Low Stock Products:</h4>
                            <?php if (count($lowStockProducts) > 0) : ?>
                                <ul class="list-group">
                                    <?php foreach ($lowStockProducts as $product) : ?>
                                        <li class="list-group-item">
                                            <a href="product_info.php?id=<?= $product['product_id'] ?>">
                                                <?= $product['product_name'] ?> (Stock: <?= $product['product_stock'] ?>)
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <script>
                                    // JavaScript code to display the pop-up notification
                                    var lowStockProducts = <?php echo json_encode($lowStockProducts); ?>;
                                    showNotification(lowStockProducts);
                                </script>
                            <?php else : ?>
                                <p>No low stock products found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->


    <?php include 'includes/javascripts.php'; ?>

</body>
</html>
