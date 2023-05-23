<?php include 'includes/session.php'; ?>

<?php

$conn = $pdo->open();

// Prepare and execute the query to retrieve low stock products
$query = "SELECT * FROM product_tbl WHERE product_stock < 10";
$statement = $conn->prepare($query);
$statement->execute();

?>

<!-- Rest of the code -->



<?php include 'includes/header.php'; ?>
<?php include 'includes/menubar.php'; ?>

<!-- ================================================== BODY ================================================== -->

<body>

    <!-- .................... MAIN BODY CONTENT .................... -->
    <main>

        <!-- ------------------------------ Title and Search Bar ------------------------------ -->
        <section class="py-4 section-1">

            <div class="container py-1">

                <div class="row text-center">

                    <div class="col-lg-12 mx-auto">

                        <h1>NOTIFICATION</h1>
                        <p class="text-muted lead"> Low stock alert: Some products have stock below 10. </p>

                        <!-- <div id="wrap">
                                
                                <form action="" autocomplete="on">
                                    <input id="search" name="search" type="text" placeholder="What're we looking for ?" value="<?php //echo $search_query; 
                                                                                                                                ?>"><input id="search_submit" value="Rechercher" type="submit">
                                </form>

                            </div> -->

                    </div>

                </div>

            </div>

        </section> <br> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->





        <?php

        // Check if there are any low stock products
        if ($statement->rowCount() > 0) {
            echo '
    <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-warning text-center" role="alert">
                        <ul>';

            // Display the low stock products
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo '<li>' . $row['product_name'] . '</li>';
            }

            echo '
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->
    ';
        }
        ?>

    </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

    <?php include 'includes/javascripts.php'; ?>



</body>

</html>