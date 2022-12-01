<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<body>

    <section class="home-section">
        
        <div class="text">Dashboard</div>

        <div class="container-fluid" style="background-color: white;">

            <?php
            if (isset($_SESSION['error'])) {
                echo "
							<div class='alert alert-danger alert-dismissible'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<h4><i class='icon fa fa-warning'></i> Error!</h4>
								" . $_SESSION['error'] . "
							</div>
						";

                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo "
							<div class='alert alert-success alert-dismissible'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<h4><i class='icon fa fa-check'></i> Success!</h4>
								" . $_SESSION['success'] . "
							</div>
						";

                unset($_SESSION['success']);
            }
            ?>

            <div class="row">
                <div class="column">
                    <h5> Purchase Overview </h5>

                    <div class="row">
                        <div class="col">

                            <div class="list-group">
                                <label class="list-group-item">
                                    <i class='bx bx-cart-add'></i>
                                    No. Purchase
                                    <?php

                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transachistory_tbl");
                                    $stmt->execute();
                                    $urow = $stmt->fetch();

                                    echo "<h3>" . $urow['numrows'] . "</h3>";
                                    ?>

                                </label>
                                <label class="list-group-item">
                                    <i class='bx bx-purchase-tag-alt'></i>
                                    Total Cost
                                    <?php

                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transachistory_tbl");
                                    $stmt->execute();
                                    $urow = $stmt->fetch();

                                    echo "<h3>" . $urow['numrows'] . "</h3>";
                                    ?>
                                </label>
                            </div>

                        </div>

                        <div class="col">

                            <div class="list-group">
                                <label class="list-group-item">
                                    <i class='bx bxs-message-square-x'></i>
                                    Cancel Order
                                    <?php

                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transachistory_tbl");
                                    $stmt->execute();
                                    $urow = $stmt->fetch();

                                    echo "<h3>" . $urow['numrows'] . "</h3>";
                                    ?>
                                </label>

                                <label class="list-group-item">
                                    <i class='bx bx-arrow-back'></i>
                                    Return
                                    <?php

                                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transachistory_tbl");
                                    $stmt->execute();
                                    $urow = $stmt->fetch();

                                    echo "<h3>" . $urow['numrows'] . "</h3>";
                                    ?>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="column">
                    <h5> Active Orders </h5>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <th> Name </th>
                                <th> Time</th>
                                <th> Done </th>
                                <th> Cancel </th>
                            </thead>
                        </table>
                    </div>

                </div>

            </div>
        </div>

        <div class="container-fluid" style="background-color: white;">
            <h5> Graph </h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus
                venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus
                eget
                aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque
                tortor sed accumsan convallis.</p>

        </div>



    </section>

</body>

</html>