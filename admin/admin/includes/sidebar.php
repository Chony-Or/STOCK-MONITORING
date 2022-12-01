<?php include 'header.php'; ?>
<link rel="stylesheet" href="css/sidebar.css">

<body>

    <div class="sidebar">

        <div class="logo-details">

            <img class="icon" src="../images/InitialLogo.ico">
            <div class="logo_name" style="font-size: 20px;"> LA BVRGS </div>
            <i class='bx bx-menu' id="btn"></i>

        </div>

        <ul class="nav-list">

            <li>
                <a href="index.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="links_name"> Dashboard </span>
                </a>
                <span class="tooltip"> Dashboard </span>
            </li>

            <li>
                <a href="user.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name"> User </span>
                </a>
                <span class="tooltip"> User </span>
            </li>

            <li>
                <a href="index.php?page=order/order_status">
                    <i class='bx bx-cart-alt'></i>
                    <span class="links_name"> Order Status </span>
                </a>
                <span class="tooltip"> Order Status </span>
            </li>
            <li>
                <a href="index.php?page=sales/sales_history">
                    <i class='bx bx-history'></i>
                    <span class="links_name"> Sales History </span>
                </a>
                <span class="tooltip"> Sales History </span>
            </li>
            <li>
                <a href="index.php?page=inventory/inventory">
                    <i class='bx bx-package'></i>
                    <span class="links_name"> Inventory </span>
                </a>
                <span class="tooltip"> Inventory </span>
            </li>

            <li class="profile">
                <div class="profile-details">
                    <img src="../images/profile.jpg" alt="profileImg">
                    <div class="name_job">
                        <div class="name"><?php echo $admin['admin_username']; ?></div>
                        <div class="job">Administrator</div>
                    </div>
                </div>
                <i class='bx bxs-user-pin' id="log_out"></i>
            </li>

            <li>
                <a href="../logout.php">
                    <i class='bx bx-log-out-circle'></i>
                    <span class="links_name"> Logout </span>
                </a>
                <span class="tooltip"> Logout </span>
            </li>

        </ul>
    </div>

    <script src="js/sidebar.js"></script>

</body>

</html>