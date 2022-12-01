<?php include 'includes/session.php' ?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="css/tabbed.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">

<body>

    <section class="home-section">


        <a href="index.php">
            <i class='bx bxs-dashboard'></i>
            <span class="links_name"> Dashboard </span>
        </a>
        <span class="tooltip"> Dashboard </span>


        <div class="text"> User </div>

        <div class="cd-tabs cd-tabs--vertical container max-width-md margin-top-xl margin-bottom-lg js-cd-tabs">
            <nav class="cd-tabs__navigation">
                <ul class="cd-tabs__list">
                    <li>
                        <a href="#tab-admin" class="cd-tabs__item cd-tabs__item--selected">
                            <i class='bx bxs-user-rectangle icon icon--xs'></i>
                            <span>Admin</span>
                        </a>
                    </li>

                    <li>
                        <a href="#tab-regular" class="cd-tabs__item">
                            <i class='bx bxs-user-account icon icon--xs'></i>
                            <span>Regular</span>
                        </a>
                    </li>

                    <li>
                        <a href="#tab-non" class="cd-tabs__item">
                            <i class='bx bxs-user icon icon--xs'></i>
                            <span>Non-Regular</span>
                        </a>
                    </li>

                </ul> <!-- cd-tabs__list -->
            </nav>

            <ul class="cd-tabs__panels">
                <li id="tab-admin" class="cd-tabs__panel cd-tabs__panel--selected text-component">
                    <div class="table-responsive">
                        <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span
                                class="glyphicon glyphicon-plus"></span> New</a>
                        <?php
                        if (isset($_SESSION['message'])) {
                        ?>
                        <div class="alert alert-info text-center" style="margin-top:20px;">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php

                            unset($_SESSION['message']);
                        }
                        ?>
                        <table class="table table-borderless">
                            <thead>
                                <th> Admin ID </th>
                                <th> Admin Username </th>
                                <th> Date Created </th>
                                <th> Date Updated </th>
                            </thead>

                            <tbody>

                                <?php

                                $conn = $pdo->open();

                                try {
                                    $sql = 'SELECT * FROM admin_tbl';
                                    foreach ($conn->query($sql) as $row) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['admin_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['admin_username']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['date_created']; ?>
                                    </td>

                                    <td>
                                        <?php echo $row['date_updated']; ?>
                                    </td>

                                    <td>
                                        <a href="#edit_<?php echo $row['admin_id']; ?>" class="btn btn-success btn-sm"
                                            data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <a href="#delete_<?php echo $row['admin_id']; ?>" class="btn btn-danger btn-sm"
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

                <li id="tab-regular" class="cd-tabs__panel text-component">
                    <div class="table-responsive">
                        <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span
                                class="glyphicon glyphicon-plus"></span> New</a>
                        <table class="table table-borderless">
                            <thead>
                                <th> ID </th>
                                <th> Customer Name </th>
                                <th> Address </th>
                                <th> Contact </th>
                                <th> Date Created </th>
                                <th> Date Updated </th>
                            </thead>

                            </tbody>
                            <?php
                            $conn = $pdo->open();

                            try {
                                $sql = 'SELECT * FROM customer_tbl';
                                foreach ($conn->query($sql) as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['customer_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_address']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_contactNo']; ?>
                                </td>
                                <td>
                                    <?php echo $row['date_created']; ?>
                                </td>
                                <td>
                                    <?php echo $row['date_updated']; ?>
                                </td>

                                <td>
                                    <a href="#edit_<?php echo $row['customer_id']; ?>" class="btn btn-success btn-sm"
                                        data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    <a href="#delete_<?php echo $row['customer_id']; ?>" class="btn btn-danger btn-sm"
                                        data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Delete</a>
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

                <li id="tab-non" class="cd-tabs__panel text-component">
                    <div class="table-responsive">
                        <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span
                                class="glyphicon glyphicon-plus"></span> New</a>
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
                                $sql = 'SELECT * FROM customer_tbl';
                                foreach ($conn->query($sql) as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['customer_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_address']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_contactNo']; ?>
                                </td>
                                <td>
                                    <?php echo $row['date_created']; ?>
                                </td>
                                <td>
                                    <?php echo $row['date_updated']; ?>
                                </td>

                                <td>
                                    <a href="#edit_<?php echo $row['customer_id']; ?>" class="btn btn-success btn-sm"
                                        data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    <a href="#delete_<?php echo $row['customer_id']; ?>" class="btn btn-danger btn-sm"
                                        data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Delete</a>
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

    <script src="js/jquery.min.js"></script>
    <script src="css/bootstrap/js/bootstrap.min.js"></script>

    <script src="js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
    <script src="js/main.js"></script>

</body>

</html>