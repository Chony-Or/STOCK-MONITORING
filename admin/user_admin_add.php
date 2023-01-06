<?php
include 'includes/session.php';

$conn = $pdo->open();

if (isset($_POST['add'])) {
    $username = $_POST['txt_username'];
    $password = $_POST['txt_password'];

    try {
        $stmt = $conn->prepare("SELECT admin_username FROM admin_tbl
        WHERE admin_username=:uname");
        $stmt->execute(array(':uname' => $username));
        $row = $stmt->fetch();

        if ($row["admin_username"] == $username) {
            $_SESSION['message'] = 'Sorry username already exists';
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

                $_SESSION['message'] = "Register Successfully..... Please Click On Login Account Link"; //execute query success message
            }
        }



    } catch (PDOException $e) {
        echo $e->getMessage();
    }

} 
$pdo->close();

header('location: user_admin.php');
?>