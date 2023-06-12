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

                        <h1> <b> Regular Customer </b> </h1>
                        <p> Add, Edit and Delete of data of the Regular Customer </p>

                        <div id="wrap">

                            <form action="" autocomplete="on">
                                <input id="search" name="search" type="text" placeholder="What're we looking for?" value="<?php echo $search_query; ?>">
                                <input id="search_submit" value="Search" type="submit">
                            </form> <br><br><br>

                            <?php if (!empty($search_query)) { ?>
                                <a href="user_regular.php" class="reset-search">Reset Search</a>
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
                            <li class="breadcrumb-item" aria-current="page">Regular</li>
                        </ol>
                    </nav>

                    <h4> Regular Customer </h4>

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
                        <a href="#add_regular" class="create-contact" data-bs-toggle="modal"> Add Regular Customer </a>

                        <table>

                            <!-- Table Headers -->
                            <thead>

                                <tr>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Updated By</th>
                                    <th scope="col">Action</th>
                                </tr>

                            </thead> <!-- End of Table Headers -->

                            <!-- Table Body -->
                            <tbody>

                                <!-- PHP Data Fetch to Display -->
                                <?php foreach ($users as $user) : ?>

                                    <tr>

                                        <!-- Data from the Controller -->
                                        <td data-label="Customer ID"><?php echo $user['customer_id']; ?></td>
                                        <td data-label="Name"><?php echo $user['customer_firstname'] . ' ' . $user['customer_lastname']; ?></td>
                                        <td data-label="Contact"><?php echo $user['customer_contactNo']; ?></td>
                                        <td data-label="Address"><?php echo $user['customer_houseno'] . ' ' . $user['customer_street'] . ' ' . $user['customer_city']; ?></td>
                                        <td data-label="Username"><?php echo $user['customer_username']; ?></td>
                                        <td data-label="Created By"><?php echo date('F j, Y h:i A', strtotime($user['date_created'])); ?></td>
                                        <td data-label="Updated By"><?php echo $user['date_updated']; ?></td>

                                        <td data-label="Action">
                                            <a href="#edit_<?php echo $user['customer_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal">
                                                <span><i class='bx bxs-edit'></i></span>
                                            </a>
                                            <a href="#delete_<?php echo $user['customer_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal">
                                                <span><i class='bx bxs-trash'></i></span>
                                            </a>
                                        </td>

                                    </tr>

                                    <!-- ------------------------------ MODAL ------------------------------ -->

                                    <!-- Add -->
                                    <div class="modal fade" id="add_regular" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <!-- Modal Add Content -->
                                            <div class="modal-content">

                                                <!-- Modal Add Header -->
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Regular User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <!-- Modal Add Body -->
                                                <div class="modal-body">

                                                    <!-- Add Form -->
                                                    <form method="POST" action="request/user_regular_add.php">

                                                        <!-- Customer Name -->
                                                        <div class="mb-3">
                                                            <label for="customer_fname" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" name="regular_fname" id="customer_fname" oninput="capitalizeFirstLetter(this)">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="customer_lname" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" name="regular_lname" id="customer_lname" oninput="capitalizeFirstLetter(this)">
                                                        </div>

                                                        <!-- Customer User Name -->
                                                        <div class="mb-3">
                                                            <label for="customer_uname" class="form-label">Username</label>
                                                            <input type="text" class="form-control" name="regular_uname" id="customer_uname" oninput="capitalizeFirstLetter(this)">
                                                        </div>

                                                        <!-- Customer Contact Number -->
                                                        <div class="mb-3">
                                                            <label for="contact" class="form-label">Contact Number</label>
                                                            <input type="number" class="form-control" name="regular_contact" id="contact">
                                                        </div>

                                                        <br>
                                                        <hr><br>

                                                        <h5 class="text-center"><b> ADDRESS </b></h5><br>

                                                        <!-- Customer Address -->
                                                        <div class="mb-3">
                                                            <label for="address_hn" class="form-label">House Number</label>
                                                            <textarea class="form-control" name="regular_address_hn" id="address_hn" users="1" oninput="capitalizeFirstLetter(this)"></textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="address_st" class="form-label">Street</label>
                                                            <textarea class="form-control" name="regular_address_st" id="address_st" users="1" oninput="capitalizeFirstLetter(this)"></textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="address_city" class="form-label">City</label>
                                                            <textarea class="form-control" name="regular_address_city" id="address_city" users="1" oninput="capitalizeFirstLetter(this)"></textarea>
                                                        </div>

                                                        <br>
                                                        <hr><br>

                                                        <!-- Customer password -->
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input type="password" class="form-control" name="regular_password" id="password">
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
                                    <div class="modal fade" id="edit_<?php echo $user['customer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_<?php echo $user['customer_id']; ?>" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <!-- Modal Edit Content -->
                                            <div class="modal-content">

                                                <!-- Modal Edit Header -->
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Regular Customer Information</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <!-- Modal Edit Body -->
                                                <div class="modal-body">

                                                    <!-- Modal Edit Form -->
                                                    <form method="POST" action="request/user_regular_edit.php?id=<?php echo $user['customer_id']; ?>">

                                                        <!-- Customer Name -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Customer Name</label>
                                                            <input type="text" class="form-control" name="rFName" value="<?php echo $user['customer_firstname']; ?>" oninput="capitalizeFirstLetter(this)">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Customer Name</label>
                                                            <input type="text" class="form-control" name="rLName" value="<?php echo $user['customer_lastname']; ?>" oninput="capitalizeFirstLetter(this)">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Customer Name</label>
                                                            <input type="text" class="form-control" name="rUName" value="<?php echo $user['customer_username']; ?>" oninput="capitalizeFirstLetter(this)">
                                                        </div>

                                                        <!-- Customer Contact Number -->
                                                        <div class="mb-3">
                                                            <label class="form-label"> Contact Number</label>
                                                            <input type="number" class="form-control" name="rContact" value="<?php echo $user['customer_contactNo']; ?>">
                                                        </div>

                                                        <br>
                                                        <hr><br>

                                                        <h5 class="text-center"><b> ADDRESS </b></h5><br>

                                                        <!-- Customer Address -->
                                                        <div class="mb-3">
                                                            <label class="form-label"> House Number </label>
                                                            <textarea class="form-control" name="rAddressHn" users="1" oninput="capitalizeFirstLetter(this)"> <?php echo $user['customer_houseno']; ?> </textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label"> Street </label>
                                                            <textarea class="form-control" name="rAddressSt" users="1" oninput="capitalizeFirstLetter(this)"> <?php echo $user['customer_street']; ?> </textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label"> City </label>
                                                            <textarea class="form-control" name="rAddressCity" users="1" oninput="capitalizeFirstLetter(this)"> <?php echo $user['customer_city']; ?> </textarea>
                                                        </div>

                                                        <br>
                                                        <hr><br>

                                                        <!-- Customer Password -->
                                                        <div class="mb-3">
                                                            <label class="form-label"> Password </label>
                                                            <input type="password" class="form-control" name="rPassword" aria-describedby="passwordNote" value="" autocomplete="off">
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
                                    <div class="modal fade" id="delete_<?php echo $user['customer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel_<?php echo $user['customer_id']; ?>" aria-hidden="true">

                                        <div class="modal-dialog">

                                            <!-- Modal Delete Content -->
                                            <div class="modal-content">

                                                <!-- Modal Delete Header -->
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Regular Customer </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <!-- Modal Delete Body -->
                                                <div class="modal-body">
                                                    <p class="text-center">Are you sure you want to Delete</p>
                                                    <h2 class="text-center"><?php echo $user['customer_firstname'] . ' ' . $user['customer_lastname']; ?></h2>
                                                </div>

                                                <!-- Modal Delete Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="request/user_regular_delete.php?id=<?php echo $user['customer_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
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

    function capitalizeFirstLetter(inputField)
    {
        var words = inputField.value.toLowerCase().split(" ");
        for (var i = 0; i < words.length; i++)
        {
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
        }
        inputField.value = words.join(" ");
    }

    </script>

</body>

</html>