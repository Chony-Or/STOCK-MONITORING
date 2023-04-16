<?php include 'header.php'; ?>

<!-- HEADER (Content inside are Brand Name and Logo) -->
<header class="header">

    <div class="container-fluid header__container">

        <img src="images/InitialLogo.png" alt="Logo Image" class="header__img">
        <a href="#" class="header__logo"> LA BVRGS </a>

        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>

    </div>

</header> <!-- HEADER END -->



<!-- SIDEBAR -->
<div class="nav" id="navbar">

    <nav class="nav__container">

        <div>

            <!-- The Current User Onlined -->
            <a href="#" class="nav__link nav__logo">
                <i class='bx bxs-disc nav__icon'></i>
                <span class="nav__logo-name"> <?php echo $admin['admin_username']; ?> </span>
            </a>

            <!-- Menu List -->
            <div class="nav__list">

                <!-- First Batch of Menu -->
                <div class="nav__items">

                    <!-- Subtitle -->
                    <h3 class="nav__subtitle"> Home </h3>

                    <!-- Dashboard Link-->
                    <a href="dashboard.php" class="nav__link">
                        <i class='bx bxs-dashboard nav__icon'></i>
                        <span class="nav__name"> Dashboard </span>
                    </a>

                    <!-- Users Link and dropdown for Sub Menus -->
                    <div class="nav__dropdown">

                        <a href="#" class="nav__link">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name"> Users </span>

                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                        </a>

                        <!-- Dropdown Sub Menu of Users Link -->
                        <div class="nav__dropdown-collapse">

                            <div class="nav__dropdown-content">
                                <a href="user_regular.php" class="nav__dropdown-item"> Regular </a>
                                <a href="user_guest.php" class="nav__dropdown-item"> Guest </a>
                                <a href="user_admin.php" class="nav__dropdown-item"> Administrators </a>
                            </div>

                        </div> <!-- END Dropdown Sub Menu of Users Link -->

                    </div> <!-- END of Users Link and dropdown for Sub Menus -->

                </div> <!-- END of First Batch of Menu -->

                <!-- Second Batch of Menu -->
                <div class="nav__items">

                    <!-- Subtitle -->
                    <h3 class="nav__subtitle"> Menu </h3>

                    <!-- Order Status Link -->
                    <a href="order_status.php" class="nav__link">
                        <i class='bx bx-cart-alt nav__icon'></i>
                        <span class="nav__name"> Order Status </span>
                    </a>

                    <!-- Sales History Link -->
                    <a href="sales_history.php" class="nav__link">
                        <i class='bx bx-history nav__icon'></i>
                        <span class="nav__name"> Sales History </span>
                    </a>

                    <!-- Inventory Link -->
                    <a href="product.php" class="nav__link">
                        <i class='bx bx-package nav__icon'></i>
                        <span class="nav__name"> Inventory </span>
                    </a>

                </div> <!-- END of Second Batch of Menu -->

            </div> <!-- END of Menu List -->

        </div>

        <a href="../logout.php" class="nav__link nav__logout">
            <i class='bx bx-log-out-circle nav__icon'></i>
            <span class="nav__name"> Log Out </span>
        </a>

    </nav>

</div> <!-- SIDE BAR END -->

