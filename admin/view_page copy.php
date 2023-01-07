<?php include 'includes/session.php' ?>

<?php

if (isset($_GET['id'])) {

		$id = $_GET['id'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM pendingorder_tbl WHERE order_number = :id");
		$stmt->execute(['id'=>$id]);
		$result = $stmt->fetch();
?>


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
                                <?php while ($row = $result->fetch_array()) : ?>
                                    <tr>
                                        <td data-label="Product"> <?= $row['product_name']; ?> </td>
                                        <td data-label="Quantity"> <?= $row['quantity']; ?> </td>
                                        <td data-label="Amount"> <?= $row['amount']; ?> </td>

                                    </tr>

                                    <!-- Include Modal php
                                    <php include('view_modal.php'); ?> -->
                            </tbody>

                        <?php endwhile; ?>
                        </table>

                    <?php
                }
                    ?>

                    </div>
                </div>

            </div>

        </div>

        </div>
        <!-- partial -->

    </body>

    </html>