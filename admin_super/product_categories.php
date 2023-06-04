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

<!-- Add -->
<div class="modal fade" id="view_categories" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <!-- Modal Add Content -->
        <div class="modal-content">

            <!-- Modal Add Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Product Categories </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Add Body -->
            <div class="modal-body">

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
                                        <?php include('product_categories_modal'); ?>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <?php
                    $stmt->close();
                }
                    ?>

            </div>

            <!-- Modal Add Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add" class="btn btn-primary">Submit</button>
            </div>

        </div>

    </div>

</div>
