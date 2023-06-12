<?php include 'includes/headers.php'; ?>
<?php include 'includes/menubar.php'; ?>

<!-- ================================================== BODY ================================================== -->

<body>

    <!-- .................... MAIN BODY CONTENT .................... -->
    <main class="py-4">

        <!-- ------------------------------ Title and Search Bar ------------------------------ -->
        <section class="py-4 section-1">

            <div class="container py-1">

                <div class="user text-center">

                    <div class="col-lg-12 mx-auto">

                        <h1> <b> Administrator </b> </h1>
                        <p> Add, Edit and Delete of data of the Administrator </p>

                        <div id="wrap">

                            <form action="" autocomplete="on">
                                <input id="search" name="search" type="text" placeholder="What're we looking for?" value="<?php echo $search_query; ?>">
                                <input id="search_submit" value="Search" type="submit">
                            </form> <br><br><br>

                            <?php if (!empty($search_query)) { ?>
                                <a href="user_guest.php" class="reset-search">Reset Search</a>
                            <?php } ?>

                        </div>

                    </div>

                </div>

            </div>

        </section> <!-- ------------------------------ End of Title and Search Bar ------------------------------ -->











        <!-- ------------------------------ CONTENT SECTION ------------------------------ -->
        <section>

            <div class="container">

                <a href="index.php" class="nav__link"> <i class='bx bx-aruser-back nav__icon'></i> Go back to Dashboard </a> <br>

                <!-- Breadcrumbs and Tab Container -->
                <div class="container-fluid" style="background-color: white;"> <br>

                    <!-- Divider -->
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Administrator</li>
                        </ol>
                    </nav>

                    <h4> Guest Customer </h4>

                    <!-- Tab -->
                    <div id="tabs" class="tabs">

                        <nav>
                            <ul>
                                <li><a href="user_regular.php"><i class='bx bxs-user'></i><span> Regular </span></a></li>
                                <li class="tab-current"><a href="user_guest.php"><i class='bx bx-user'></i><span> Guest </span></a></li>
                                <li class="tab-current"><a href="user_admin.php"><i class='bx bxs-user-account'></i><span> Admin </span></a></li>
                            </ul>
                        </nav> <br>

                    </div>

                </div> <!-- END of Breadcrumbs and Tab Container -->

                <!-- TABLE CONTAINER -->
                <div class="container-fluid" style="background-color: white;">

                    <div class="container"> <br>

                        <!-- Add Button -->
                        <a href="#add_admin" class="create-contact" data-bs-toggle="modal"> Add Admin Customer </a>

                        <table>

                            <!-- Table Headers -->
                            <thead>

                                <tr>
                                    <th scope="col">Admin ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Date Updated</th>
                                    <th scope="col"></th>
                                </tr>

                            </thead> <!-- End of Table Headers -->

                            <!-- Table Body -->
                            <tbody>

                                <!-- PHP Data Fetch to Display -->
                                <?php foreach ($users as $user) : ?>

                                    <tr>

                                        <!-- Data from the Controller -->
                                        <td data-label="Admin ID"><?php echo $user['admin_id']; ?> </td>
                                        <td data-label="Username"><?php echo $user['admin_username']; ?> </td>
                                        <td data-label="Created By"><?php echo date('F j, Y h:i A', strtotime($user['date_created'])); ?></td>
                                        <td data-label="Updated By"><?php echo $user['date_updated']; ?></td>

                                        <td data-label="Action">
                                            <a href="#edit_<?php echo $user['admin_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                <span><i class='bx bxs-edit'></i></span>
                                            </a>
                                            <a href="#delete_<?php echo $user['admin_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal">
                                                <span><i class='bx bxs-trash'></i></span>
                                            </a>
                                        </td>

                                    </tr>

                                    <!-- ------------------------------ MODAL ------------------------------ -->

                                    <!-- Add -->
                                    <div class="modal fade" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <!-- Modal Add Content -->
                                            <div class="modal-content">

                                                <!-- Modal Add Header -->
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Admin</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <!-- Modal Add Body -->
                                                <div class="modal-body">

                                                    <!-- Modal Add Form -->
                                                    <form method="POST" action="request/user_admin_add.php">

                                                        <!-- Admin Username -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Username</label>
                                                            <input type="text" class="form-control" name="txt_username">
                                                        </div>

                                                        <!-- Admin Password -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" class="form-control" name="txt_password">
                                                        </div>

                                                </div>

                                                <!-- Modal Add Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="add" class="btn btn-primary">Submit</button>
                                                    </form> <!-- END OF FORM -->
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- Edit -->
                                    <div class="modal fade" id="edit_<?php echo $user['admin_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_<?php echo $user['customer_id']; ?>" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <!-- Modal Edit Content -->
                                            <div class="modal-content">

                                                <!-- Modal Edit Header -->
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin Information</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <<!-- Modal Edit Body -->
                                                    <div class="modal-body">

                                                        <!-- Modal Edit Form -->
                                                        <form method="POST" action="request/user_admin_edit.php?id=<?php echo $user['admin_id']; ?>">

                                                            <!-- Edit Username -->
                                                            <div class="mb-3">
                                                                <label class="form-label">Username: </label>
                                                                <input type="text" class="form-control" name="admin_uname" value="<?php echo $user['admin_username']; ?>">
                                                            </div>

                                                            <!-- Edit Password -->
                                                            <div class="mb-3">
                                                                <label for="admin_pass" class="form-label">Password: </label>
                                                                <input type="password" class="form-control" name="admin_pass" aria-describedby="passwordNote" value="" autocomplete="off">
                                                                <div id="passwordNote" class="form-text">Leave this blank if you do not want to change password. </div>
                                                            </div>

                                                    </div>

                                                    <!-- Modal Edit Footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                                                        </form> <!-- End of Edit Form -->
                                                    </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- Delete -->
                                    <div class="modal fade" id="delete_<?php echo $user['admin_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel_<?php echo $user['customer_id']; ?>" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <!-- Modal Delete Content -->
                                            <div class="modal-content">

                                                <!-- Modal Delete Header -->
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Admin </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <!-- Modal Delete Body -->
                                                <div class="modal-body">
                                                    <p class="text-center">Are you sure you want to Delete</p>
                                                    <h2 class="text-center"><?php echo $user['admin_username']; ?></h2>
                                                </div>

                                                <!-- Modal Delete Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="request/user_admin_delete.php?id=<?php echo $user['admin_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                <?php endforeach; ?>

                            </tbody> <!-- End of Table Body -->

                        </table> <!-- END OF TABLE -->

                    </div> <!-- END OF CONTAINER OF TABLE -->

                </div> <!-- END OF CONTAINER FLUID OF TABLE -->

        </section> <!-- ------------------------------ END OF CONTENT SECTION ------------------------------ -->

    </main> <!-- .................... END OF MAIN BODY CONTENT .................... -->

    <?php include 'includes/javascripts.php'; ?>

    <script>
        function capitalizeFirstLetter(inputField) {
            var words = inputField.value.toLowerCase().split(" ");
            for (var i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
            }
            inputField.value = words.join(" ");
        }
    </script>

</body>

</html>