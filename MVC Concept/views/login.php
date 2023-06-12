<!DOCTYPE html>
<html>

    <!-- ================================================== HEADER ================================================== -->
    <head>

        <!-- Responsiveness -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS Links -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <link rel="icon" type="icon" href="../additionals/images/InitialLogo.png">
        <link rel="stylesheet" href="../additionals/css/login_style.css">
        <link rel="stylesheet" href="../additionals/css/bootstrap.min.css">

        <!-- Title -->
        <title> Laconsay Beverages </title>

    </head>

    <!-- ================================================== NAVIGATION BAR ================================================== -->
    <!-- Navbar but Logo only -->
    <nav class="navigation" id="navigation">

        <div class="content-wrapper">

            <a href=""> <img src="../additionals/images/InitialLogo.png"> </a>
            <a href="" class="brand"> Laconsay Beverages </a>

        </div>

    </nav> <!-- ================================================== END OF NAVIGATION BAR ================================================== -->





     <!-- ================================================== BODY ================================================== -->
    <body>

        <div class="content">

            <div class="container">

                <div class="row">

                    <div class="col-md-6">

                        <!-- Content Design Only -->
                        <div class="text-block text-center">
                            <h1> Beverages </h1>
                            <p> Good Sip for Good Moments </p>
                        </div>

                        <img src="../additionals/images/Image_3.png" alt="Image" class="img-fluid">

                    </div>

                    <div class="col-md-6 contents">

                        <div class="row justify-content-center">

                            <div class="col-md-8">

                                <div class="mb-4">
                                    <h1><strong>Log In</strong></h1>
                                </div>

                                <!-- ------------------------------ PHP CODE ------------------------------ -->
                                <!-- Verification for Login Input -->
                                <?php
                                    if (isset($_SESSION['error']))
                                    {
                                        echo"
										    <div class='callout callout-danger text-center'>
											    <p>" . $_SESSION['error'] . "</p> 
										    </div>
									    ";

                                        unset($_SESSION['error']);
                                    }

                                    if (isset($_SESSION['success']))
                                    {
                                        echo "
										    <div class='callout callout-success text-center'>
											    <p>" . $_SESSION['success'] . "</p> 
										    </div>
									    ";

                                        unset($_SESSION['success']);
                                    }
                                ?> <!-- ------------------------------ END OF PHP CODE ------------------------------ -->

                                <!-- ----- FORM ----- -->
                                <form action="../controllers/verify.php" method="POST">

                                    <!-- Username -->
                                    <div class="form-group first input-icons">

                                        <i class="fas fa-user-alt icon"></i>
                                        <input type="text" class="form-control" name="txt_username" placeholder="Username" required>

                                    </div>

                                    <!-- Password -->
                                    <div class="form-group last mb-4 input-icons">

                                        <i class="fas fa-lock icon"></i>
                                        <input type="password" class="form-control" name="txt_password" placeholder="Password" required>

                                    </div>

                                    <div class="btn-right">

                                        <button type="submit" name="btn_login">
                                            <img src="../additionals/images/Login_Icon.png" alt="submit" width="150" height="150" position="right" />
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body> <!-- ================================================== END OF BODY ================================================== -->

</html>