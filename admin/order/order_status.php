<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<body>

    <section class="home-section">

        <div class="text"> Order Status </div>

        <?php 
                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert alert-info text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>

        <div class="container-fluid" style="background-color: white;">
            <a href="order_create">Create New</a>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <th> Pending Order ID </th>
                        <th> Product ID </th>
                        <th> Customer ID </th>
                        <th> Quantity </th>
                        <th> Amount </th>
                        <th> Date Created </th>
                    </thead>
                </table>
            </div>

    </section>

</body>

</html>