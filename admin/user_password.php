<?php
include 'includes/session.php';
$conn = $pdo->open();

if(isset($_POST['change_password'])){

    $sql = "SELECT * FROM admin_tbl WHERE admin_id= ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $_SESSION["admin_id"]);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    if (! empty($row)) {
        $hashedPassword = $row["admin_password"];
        $password = PASSWORD_HASH($_POST["newPassword"], PASSWORD_DEFAULT);
        if (password_verify($_POST["currentPassword"], $hashedPassword)) {
            $sql = "UPDATE admin_tbl set password=? WHERE admin_id=?";
            $statement = $conn->prepare($sql);
            $statement->bind_param('si', $password, $_SESSION["admin_id"]);
            $statement->execute();
            $message = "Password Changed";
        } else
            $message = "Current Password is not correct";
    }
}
header('location: user.php');
?>