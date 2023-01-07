<link rel="stylesheet" href="css/sidebar.css">

<!-- partial:index.partial.html -->
<div class='dashboard'>

    <div class="dashboard-nav">

        <header>
            <a href="index.php" class="menu-toggle">
                <i class='bx bx-menu'> </i>
            </a>
            <a href="index.php" class="brand-logo">
                <img class="p_img" src="../images/InitialLogo.ico" alt="Logo Image">
                <span>LA BVRGS</span>
            </a>
        </header>

        <nav class="dashboard-nav-list">


            <div class="profile">
                <div class="profile-details">
                    <img class="p_img" src="../images/profile.jpg" alt="profileImg">
                    <div class="name_job">
                        <div class="name"> <?php echo $admin['admin_username']; ?>
                        </div>
                        <div class="job">Administrator</div>
                    </div>
                </div>
                <!-- <i class='bx bxs-user-pin' id="log_out"></i> -->
            </div>



            <a href="index.php" class="dashboard-nav-item active">
                <i class='bx bxs-dashboard'></i>
                Dashboard
            </a>

            <a href="user_admin.php" class="dashboard-nav-item">
                <i class='bx bx-user'></i>
                Users
            </a>

            <a href="order.php" class="dashboard-nav-item">
                <i class='bx bx-cart-alt'></i>
                Order Status
            </a>

            <a href=sales.php" class="dashboard-nav-item">
            <i class='bx bx-history'></i>
                Sales History
            </a>

            <div class='dashboard-nav-dropdown'>
                <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle">
                    <i class='bx bx-package'></i>
                    Inventory
                </a>

                <div class='dashboard-nav-dropdown-menu'>
                    <a href="category.php" class="dashboard-nav-dropdown-item">Category</a>
                    <a href="index.php?page=product" class="dashboard-nav-dropdown-item">Product</a>
                </div>
            </div>

            <div class="nav-item-divider"></div>
            <a href="../logout.php" class="dashboard-nav-item">
                <i class='bx bx-log-out-circle'></i>
                Logout
            </a>
        </nav>

    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
    <script src="js/sidebar.js"></script>