<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop-down Profile Menu</title>
    <link rel="stylesheet" href="css/navbar1.css">
 
</head>
<body>
    <div class="hero">
        <nav>
            <img src="../images/LA_logo.png" class="logo">
    
            <img src="../images/admin.jpg.png" class="user-pic" onclick="toggleMenu()">
            
            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="images/admin.jpg.png">
                        <h3>Admin name</h3>
                    </div>
                    <hr>

                    <a href="#" class="sub-menu-link">
                        <img src="images/profile.png">
                        <p>Edit Profile</p>
                        <span>></span>
                    </a>
                    
                    <a href="#" class="sub-menu-link">
                        <img src="images/logout.png">
                        <p>Logout</p>
                        <span>></span>
                    </a>

            </div>    
            </div>

        </nav>


    </div>

<script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }

</script>


</body>
</html>