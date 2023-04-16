<?php

    Class Database{
 
	    private $server = "mysql:host=localhost;dbname=la_bvrgs";
	    private $username = "root";
	    private $password = "";
	    private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	    protected $conn;
 	
	    public function open()
	    {
 		    try
		    {
 			    $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			    return $this->conn;
 		    }
 		    
            catch (PDOException $e)
		    {
 			    echo "There is some problem in connection: " . $e->getMessage();
 		    }
 
        }
 
	    public function close()
	    {
   		    $this->conn = null;
 	    } 
    }

    $pdo = new Database();

    // Template header, feel free to customize this
    function template_header($title)
    {
        // Get the amount of items in the shopping cart, this will be displayed in the header.
        $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        
        echo <<<EOT

            <!DOCTYPE html>
            <html lang="en" dir="ltr">

            <head>

                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <!-- Boxicons CDN Link For Sidebar -->
                <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

                <!-- Bootstrap Link For Responsiveness -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

                <!-- Inventory Link -->
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    
                <!-- Tabbed Links -->
                <script>document.getElementsByTagName("html")[0].className += " js";</script>
                <link rel="stylesheet" href="assets/css/style.css">

                <!-- CSS LINK -->
                <link rel="stylesheet" href="css/styles.css">

                <!-- Title -->
                <title> Laconsay Beverages </title>
                    <link rel="icon" type="icon" href="../images/InitialLogo.png">
            </head>
        EOT;
    }
?>