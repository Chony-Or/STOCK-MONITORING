<?php

// Connect to database
$con = mysqli_connect("localhost", "root", "", "la_bvrgs");

// mysqli_connect("servername","username","password","database_name")

// Get all the categories from category table
$sql = "SELECT * FROM `productclass_tbl`";
$all_categories = mysqli_query($con, $sql);

?>

<!-- Add Products -->
<div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="product_add.php">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="product">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category">
                            <?php
                            // use a while loop to fetch data
                            // from the $all_categories variable
                            // and individually display as an option
                            while ($category = mysqli_fetch_array($all_categories, MYSQLI_ASSOC)) :;
                            ?>
                                <option value="<?php echo $category["productClass_id"]; // The value we usually set is the primary key
                                                ?>">
                                    <?php echo $category["product_class"];
                                    // To show the category name to the user
                                    ?>
                                </option>
                            <?php
                            endwhile;
                            // While loop must be terminated
                            ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                </form>
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