<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/tabbed.css">

<body>

    <section class="home-section">

        <div class="text"> Sales History </div>

        <div class="cd-tabs cd-tabs--vertical container max-width-md margin-top-xl margin-bottom-lg js-cd-tabs">
            <nav class="cd-tabs__navigation">
                <ul class="cd-tabs__list">
                    <li>
                        <a href="#tab-regular" class="cd-tabs__item cd-tabs__item--selected">
                            <span>Regular</span>
                        </a>
                    </li>

                    <li>
                        <a href="#tab-guest" class="cd-tabs__item">
                            <span>Guest</span>
                        </a>
                    </li>

                </ul> <!-- cd-tabs__list -->
            </nav>

            <ul class="cd-tabs__panels">
                <li id="tab-regular" class="cd-tabs__panel cd-tabs__panel--selected text-component">
                    <div class="table-responsive">
                        <a href="order_create">Create New</a>
                        <table class="table table-borderless">
                            <thead>
                                <th> Admin ID </th>
                                <th> Admin Username </th>
                                <th> Date Created </th>
                                <th> Date Updated </th>
                            </thead>
                        </table>
                    </div>
                </li>

                <li id="tab-guest" class="cd-tabs__panel text-component">
                    <div class="table-responsive">
                        <a href="order_create">Create New</a>
                        <table class="table table-borderless">
                            <thead>
                                <th> Customer ID </th>
                                <th> Customer Name </th>
                                <th> Customer Address </th>
                                <th> Customer Contact </th>
                                <th> Date Created </th>
                            </thead>
                        </table>
                    </div>
                </li>

            </ul> <!-- cd-tabs__panels -->
        </div> <!-- cd-tabs -->
    </section>

    <script src="js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
    <script src="js/main.js"></script>

</body>

</html>