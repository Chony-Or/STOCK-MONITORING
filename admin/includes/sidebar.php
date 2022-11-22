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
                <a href="dashboard.php">
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
                <a href="order_status.php">
                    <i class='bx bx-cart-alt'></i>
                    <span class="links_name"> Order Status </span>
                </a>
                <span class="tooltip"> Order Status </span>
            </li>
            <li>
                <a href="sales_history.php">
                    <i class='bx bx-history'></i>
                    <span class="links_name"> Sales History </span>
                </a>
                <span class="tooltip"> Sales History </span>
            </li>
            <li>
                <a href="inventory.php">
                    <i class='bx bx-package'></i>
                    <span class="links_name"> Inventory </span>
                </a>
                <span class="tooltip"> Inventory </span>
            </li>

            <li class="profile">
                <div class="profile-details">
                    <img src="../images/profile.jpg" alt="profileImg">
                    <div class="name_job">
                        <div class="name">Angelica Gumanid</div>
                        <div class="job">Web designer</div>
                    </div>
                </div>
                <i class='bx bxs-user-pin' id="log_out"></i>
            </li>
        </ul>
    </div>

    <script src="js/sidebar.js"></script>

</body>

</html>