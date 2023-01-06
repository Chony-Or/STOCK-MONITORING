<?php
include 'includes/session.php';

$conn = $pdo->open();

try {
    $stmt = $conn->prepare("SELECT *, transachistory_tbl.transac_id AS transactid FROM transachistory_tbl LEFT JOIN customer_tbl ON customer_tbl.customer_id=transachistory_tbl.customer_id ORDER BY date_created DESC");
    $stmt->execute();
    foreach ($stmt as $row) {
        $stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE details.sales_id=:id");
        $stmt->execute(['id' => $row['salesid']]);
        $total = 0;
        foreach ($stmt as $details) {
            $subtotal = $details['price'] * $details['quantity'];
            $total += $subtotal;
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

$pdo->close();
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

                <h4> Sales History </h4>

                <div class="container-fluid" style="background-color: white;">

                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Transaction ID">Sample</td>
                                <td data-label="Customer">Sample</td>
                                <td data-label="Amount">Sample</td>
                                <td data-label="Date">Sample</td>
                                <td data-label="Amount">Sample</td>
                                <td data-label="Date Created">Sample</td>
                            </tr>

                            <tr>
                                <td class='hidden'></td>
                                <td>" . date('M d, Y', strtotime($row['sales_date'])) . "</td>
                                <td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>
                                <td>" . $row['pay_id'] . "</td>
                                <td>&#36; " . number_format($total, 2) . "</td>
                                <td><button type='button' class='btn btn-info btn-sm btn-flat transact' data-id='" . $row[' salesid'] . "'><i class='fa fa-search'></i> View</button></td>
                          </tr>
                          
                            <tr>
                                <td scope=" row" data-label="Pending Order">Sample</td>
                                <td data-label="Product ID">Sample</td>
                                <td data-label="Customer ID">Sample</td>
                                <td data-label="Quantity">Sample</td>
                                <td data-label="Amount">Sample</td>
                                <td data-label="Date Created">Sample</td>
                            </tr>
                            <tr>
                                <td scope="row" data-label="Pending Order">Sample</td>
                                <td data-label="Product ID">Sample</td>
                                <td data-label="Customer ID">Sample</td>
                                <td data-label="Quantity">Sample</td>
                                <td data-label="Amount">Sample</td>
                                <td data-label="Date Created">Sample</td>
                            </tr>
                            <tr>
                                <td scope="row" data-label="Pending Order">Sample</td>
                                <td data-label="Product ID">Sample</td>
                                <td data-label="Customer ID">Sample</td>
                                <td data-label="Quantity">Sample</td>
                                <td data-label="Amount">Sample</td>
                                <td data-label="Date Created">Sample</td>
                            </tr>
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