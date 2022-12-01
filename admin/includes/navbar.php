<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/navbar1.css">
</head>

<body>
    <div class="hero">
        <nav>
            <img src="../images/LA_logo.png" class="logo">

            <img src="../images/Profile.jpg" class="user-pic" onclick="toggleMenu()">


             <a href="index.php">
                <span class="links_name"> Back to Dashboard </span>
            </a>

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="../images/Profile.jpg">
                        <h3><?php echo $admin['admin_username']; ?></h3>
                    </div>
                    <hr>

                    <a href="../logout.php" class="sub-menu-link">
                        <img src="../images/logout.png">
                        <p>Logout</p>
                        <span>></span>
                    </a>

                </div>
            </div>

        </nav>


    </div>

    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }

    </script>


</body>

</html>