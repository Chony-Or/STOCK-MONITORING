<?php include 'includes/session.php' ?>


<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/table1.css">


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

                <div class="container-fluid" style="background-color: white;">
                    <h5>Pending Orders </h5>


                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $conn = new mysqli('localhost', 'root', '', 'la_bvrgs');
                            // Check to make sure the id parameter is specified in the URL
                            if (isset($_GET['id'])) {

                                $id = isset($_GET['id']);
                                // Prepare statement and execute, prevents SQL injection
                                $result = $conn->query("SELECT * FROM pendingorder_tbl WHERE order_number = '$id' ");
                                $stmt->execute();
                                
                                while ($row = $result->fetch_assoc()) {
                                    $product_name = $row['product_name'];
                                    $quantity = $row['quantity'];
                                    $amount = $row['amount'];
                                    echo '
                                            <tr>
                                                <td data-label=Product> ' . $product_name . ' </td>
                                                <td data-label=Quantity> ' . $quantity . ' </td>
                                                <td data-label=Amount> ' . $amount . ' </td>

                                            </tr>';
                                }
                            }

                            ?>

                            <!-- Include Modal php
                                    <php include('view_modal.php'); ?> -->
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>

    </div>
    <!-- partial -->

</body>

</html>