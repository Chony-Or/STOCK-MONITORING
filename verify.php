<?php 

    include 'includes/session.php';

    $conn = $pdo->open();

    if (isset($_POST['btn_login']))
    {
        $username = $_POST['txt_username'];
        $password = $_POST['txt_password'];

        try
        {
            $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM admin_tbl WHERE admin_username=:uname");
            $stmt->execute([':uname' => $username]);
            $row = $stmt->fetch();

            if ($row['numrows'] > 0)
            {
                if ($username == $row["admin_username"]) 
                {
                    if (password_verify($password, $row['admin_password']))
                    {
                        $_SESSION["admin_login"] = $row["admin_id"]; //session name is "user_login"
                    } 
                    
                    else 
                        $_SESSION['error'] = 'Incorrect Password';
                }

                else 
                {
                    $_SESSION['error'] = 'Account not activated.';
                }
            }
            
            else 
            {
                $_SESSION['error'] = 'Email not found';
            }
        } 
        
        catch (PDOException $e)
        {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }
    
    else 
    {
        $_SESSION['error'] = 'Input login credentials first';
    }

    $pdo->close();

    header('location: login.php');
?>