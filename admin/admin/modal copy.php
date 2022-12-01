<?php include 'includes/session.php' ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/modal.css">

<body>

    <section class="home-section">

        <div class="text"> User </div>

        <a href="#" data-modal=".myModal">Open Modal</a>
        <a href="#" data-modal=".myModal2">Open Modal 2</a>

        <div class="modal myModal">
            <div class="container">
                <div class="header">
                    <h1>My Modal</h1>
                    <button class="close">&times;</button>
                </div>
                <div class="content">
                    Hello World!
                </div>
                <div class="footer">
                    <button class="close">Close</button>
                </div>
            </div>
        </div>

        <div class="modal myModal2" data-effect="slide">
            <div class="container">
                <div class="header">
                    <h1>My Modal 2</h1>
                    <button class="close">&times;</button>
                </div>
                <div class="content">
                    Content for modal 2.
                </div>
            </div>
        </div>

    </section>

    <script src="js/modal.js"></script>
        <script> Modal.initElements(); </script>

</body>

</html>