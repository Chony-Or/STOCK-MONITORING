<?php

// Connect to database
$dsn = "mysql:host=localhost;dbname=la_bvrgs;charset=utf8";
$username = "root";
$password = "";
$options = [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get all the categories from category table
$sql = "SELECT * FROM `productclass_tbl`";
$stmt = $pdo->query($sql);
$all_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Add Products -->
<div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="product_add.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input class="form-control" type="file" name="image" id="image">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Product Code</label>
                        <input type="text" class="form-control" name="code" id="code">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" name="price" id="price">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" class="form-control" name="stock" id="stock">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category" id="category">
                            <?php foreach ($all_categories as $row) : ?>
                                <option value="<?php echo $row["productClass_id"]; ?>">
                                    <?php echo $row["product_class"]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="Submit">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Products -->
<div class="modal fade" id="edit_<?= $product['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="product_edit.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <div class="col-md-4">
                            <img src="./productsImages/<?= $product['product_picture'] ?>" width="100"> <br>
                        </div>
                        <input class="form-control" type="file" name="image" value="">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="<?= $product['product_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Product Code</label>
                        <input type="text" class="form-control" name="product_code" value="<?= $product['product_code']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" name="product_price" value="<?= $product['product_price']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" class="form-control" name="product_stock" value="<?= $product['product_stock']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category" value="<?= $product['productClass_id']; ?>">
                            <?php foreach ($all_categories as $row) : ?>
                                <option value="<?php echo $row["productClass_id"]; ?>" <?php if ($row["productClass_id"] == $product['productClass_id']) echo 'selected'; ?>>
                                    <?php echo $row["product_class"]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="Submit">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete -->
<div class="modal fade" id="delete_<?= $product['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">

        <!-- Modal Delete Content -->
        <div class="modal-content">

            <!-- Modal Delete Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Delete Body -->
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete</p>
                <h2 class="text-center"><?= $product['product_name'] ?>"</h2>
            </div>

            <!-- Modal Delete Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="product_delete.php?id=<?= $product['product_id'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
</script>
