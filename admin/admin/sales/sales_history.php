<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/tabbed.css">

<body>

    <section class="home-section">

        <div class="text"> Sales History </div>

        <div class="cd-tabs cd-tabs--vertical container max-width-md margin-top-xl margin-bottom-lg js-cd-tabs">
            <nav class="cd-tabs__navigation">
                <ul class="cd-tabs__list">
                    <li>
                        <a href="#tab-sales" class="cd-tabs__item cd-tabs__item--selected">
                            <span>Sales</span>
                        </a>
                    </li>

                    <li>
                        <a href="#tab-cancelled" class="cd-tabs__item">
                            <span>Cancelled</span>
                        </a>
                    </li>

                </ul> <!-- cd-tabs__list -->
            </nav>

            <ul class="cd-tabs__panels">
                <li id="tab-sales" class="cd-tabs__panel cd-tabs__panel--selected text-component">
                    <div class="table-responsive">
                    <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> New</a>
                        <table class="table table-borderless">
                            <thead>
                                <th> Transact </th>
                                <th> Customer </th>
                                <th> Order </th>
                                <th> Date Created </th>
                            </thead>

                            
                            </tbody>
                            <?php
                                $conn = $pdo->open();

                                try {
                                    $sql = 'SELECT * FROM transachistory_tbl';
                                    foreach ($conn->query($sql) as $row) {
                                ?>
                            <tr>
                                <td>
                                    <?php echo $row['transac_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['activeOrder_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['date_created']; ?>
                                </td>

                                <td>
                                <a href="#edit_<?php echo $row['transac_id']; ?>" class="btn btn-success btn-sm"
                                            data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <a href="#delete_<?php echo $row['transac_id']; ?>" class="btn btn-danger btn-sm"
                                            data-toggle="modal"><span class="glyphicon glyphicon-trash"></span>
                                            Delete</a>
                                </td>
                                <?php include('user_warning_modal.php'); ?>
                            </tr>
                            <?php
                                    }
                                } catch (PDOException $e) {
                                    echo "There is some problem in connection: " . $e->getMessage();
                                }

                                //close connection
                                $pdo->close();
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </li>

                <li id="tab-cancel" class="cd-tabs__panel text-component">
                    <div class="table-responsive">
                        <a href="order_create">Create New</a>
                        <table class="table table-borderless">
                            <thead>
                                <th> Customer ID </th>
                                <th> Customer Name </th>
                                <th> Customer Address </th>
                                <th> Customer Contact </th>
                                <th> Date Created </th>
                            </thead>

                            </tbody>
                            <?php
                                $conn = $pdo->open();

                                try {
                                    $sql = 'SELECT * FROM transachistory_tbl';
                                    foreach ($conn->query($sql) as $row) {
                                ?>
                            <tr>
                                <td>
                                    <?php echo $row['transac_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['activeOrder_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['date_created']; ?>
                                </td>

                                <td>
                                <a href="#edit_<?php echo $row['transac_id']; ?>" class="btn btn-success btn-sm"
                                            data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <a href="#delete_<?php echo $row['transac_id']; ?>" class="btn btn-danger btn-sm"
                                            data-toggle="modal"><span class="glyphicon glyphicon-trash"></span>
                                            Delete</a>
                                </td>
                                <?php include('user_warning_modal.php'); ?>
                            </tr>
                            <?php
                                    }
                                } catch (PDOException $e) {
                                    echo "There is some problem in connection: " . $e->getMessage();
                                }

                                //close connection
                                $pdo->close();
                                    ?>
                            </tbody>
                            
                        </table>
                    </div>
                </li>

            </ul> <!-- cd-tabs__panels -->
        </div> <!-- cd-tabs -->
    </section>

    <script src="js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
    <script src="js/main.js"></script>

</body>

</html>