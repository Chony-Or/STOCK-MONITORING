<?php include 'includes/session.php' ?>

<?php
// Connect to MySQL database
$conn = $pdo->open();

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $conn->prepare('SELECT * FROM admin_tbl ORDER BY admin_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $conn->query('SELECT COUNT(*) FROM admin_tbl')->fetchColumn();
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/tabbed.css">
<link rel="stylesheet" href="css/user.css">

<body>

    <section class="home-section">

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
                        <table class="table table-borderless">
                            <thead>
                                <th> Admin ID </th>
                                <th> Admin Username </th>
                                <th> Date Created </th>
                                <th> Date Updated </th>
                            </thead>

                            <tbody>

                                <?php foreach ($contacts as $contact): ?>
                                <tr>
                                    <td>
                                        <?= $contact['admin_id'] ?>
                                    </td>
                                    <td>
                                        <?= $contact['admin_username'] ?>
                                    </td>
                                    <td>
                                        <?= $contact['date_created'] ?>
                                    </td>
                                    <td>
                                        <?= $contact['date_updated'] ?>
                                    </td>
                                    <td class="actions">
                                        <a href="user_edit.php?id=<?= $contact['admin_id'] ?>" class="edit"><i
                                                class="fas fa-pen fa-xs"></i></a>
                                        <a href="change_password.php?id=<?= $contact['admin_id'] ?>" class="trash"><i
                                                class="fas fa-trash fa-xs"></i></a>
                                        <a href="delete.php?id=<?= $contact['admin_id'] ?>" class="trash"><i
                                                class="fas fa-trash fa-xs"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

                        <div class="pagination">
                            <?php if ($page > 1): ?>
                            <a href="read.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
                            <?php endif; ?>
                            <?php if ($page * $records_per_page < $num_contacts): ?>
                            <a href="read.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
                            <?php endif; ?>
                        </div>
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

    <script src="js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
    <script src="js/main.js"></script>

</body>

</html>