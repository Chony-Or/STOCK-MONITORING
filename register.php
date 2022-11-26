<?php
include 'includes/session.php';
$conn = $pdo->open();

if (isset($_POST['btn_register'])) {
    $username = $_POST['txt_username'];
    $password = $_POST['txt_password'];

    try {
        $stmt = $conn->prepare("SELECT admin_username FROM admin_tbl
        WHERE admin_username=:uname");
        $stmt->execute(array(':uname' => $username));
        $row = $stmt->fetch();

        if ($row["admin_username"] == $username) {
            $_SESSION['error'] = 'Sorry username already exists';
        } else if (!isset($errorMsg)) //check no "$errorMsg" show then continue
        {
            $new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()

            $insert_stmt = $conn->prepare("INSERT INTO admin_tbl	(admin_username,admin_password) VALUES
																(:uname,:upassword)"); //sql insert query					

            if (
                $insert_stmt->execute(
                    array(
                        ':uname' => $username,
                        ':upassword' => $new_password
                    )
                )
            ) {

                $_SESSION['error'] = "Register Successfully..... Please Click On Login Account Link"; //execute query success message
            }
        }



    } catch (PDOException $e) {
        echo $e->getMessage();
    }

} 
$pdo->close();

?>

<!DOCTYPE html>
<html>

<head>

	<!-- Responsiveness -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS Links -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<link rel="icon" type="icon" href="images/InitialLogo.png">
	<link rel="stylesheet" href="css/login_style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Title -->
	<title> Laconsay Beverages </title>

</head>

<!-- Navbar but Logo only -->
<nav class="navigation" id="navigation">

	<div class="content-wrapper">

		<a href=""> <img src="images/InitialLogo.png"> </a>
		<a href="" class="brand"> Laconsay Beverages </a>

	</div>

</nav>

<body>

	<div class="content">

		<div class="container">

			<div class="row">

				<div class="col-md-6">

					<!-- Content Design Only -->
					<div class="text-block">
						<h1> Beverages </h1>
						<p> Good Sip for Good Moments </p>
					</div>

					<img src="images/Image_2.png" alt="Image" class="img-fluid">

				</div>

				<div class="col-md-6 contents">

					<div class="row justify-content-center">

						<div class="col-md-8">

							<div class="mb-4">
								<h2><strong> Register </strong></h2>
							</div>

							<!-- Verification for Login Input -->
							<?php
                            if (isset($_SESSION['error'])) {
	                            echo "
										<div class='callout callout-danger text-center'>
											<p>" . $_SESSION['error'] . "</p> 
										</div>
									";
	                            unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
	                            echo "
										<div class='callout callout-success text-center'>
											<p>" . $_SESSION['success'] . "</p> 
										</div>
									";
	                            unset($_SESSION['success']);
                            }
                            ?>

							<!-- Form -->
							<form method="POST">

								<div class="form-group first input-icons">

									<i class="fas fa-user-alt icon"></i>
									<input type="text" class="form-control" name="txt_username" placeholder="Enter Username"
										required>

								</div>

								<div class="form-group last mb-4 input-icons">

									<i class="fas fa-lock icon"></i>
									<input type="password" class="form-control" name="txt_password"
										placeholder="Enter Passwords" required>

								</div>

								<div class="d-flex mb-5 align-items-center">

									<label class="control control--checkbox mb-0"><span class="caption">Remember
											me</span>

										<input type="checkbox" checked="checked" />
										<div class="control__indicator"></div>

									</label>

								</div>

                                <a href="login.php"> Login Account </a>

								<div class="btn-right">

									<button type="submit" name="btn_register">

										<img src="./images/Login_Icon.png" alt="submit" width="150" height="150"
											position="right" />

									</button>

								</div>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</body>

</html>