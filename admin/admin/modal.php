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
                    <h3>Edit Admin Information</h3>
                    <button class="close">&times;</button>
                </div>

                <div class="content">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="email" class="form-control" id="exampleInputEmail1">

                        </div>
                    </form>
                </div>
                <div class="footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button class="close">Cancel</button>
                </div>
            </div>
        </div>

    </section>

    <script src="js/modal.js"></script>
    <script> Modal.initElements(); </script>

</body>

</html>