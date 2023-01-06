<!-- USER CSS DONE -->

<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/tabbed_demo.css" />
<link rel="stylesheet" type="text/css" href="css/tabbed_component.css" />
<link rel="stylesheet" href="css/table1.css">

<body>

<!-- MISSING: SEARCH BAR AND DROPDOWN FILTER MENU -->

    <!-- Inner Content Code -->

    <div class='dashboard-app'>

        <header class='dashboard-toolbar'>

            <a href="#!" class="menu-toggle">
                <i class="fas fa-bars"></i>
            </a>

        </header>

        <div class='dashboard-content'>

            <div class='container'>

                <h4> User </h4>

                <div class="container-fluid" style="background-color: white;">

                    <div class="container">

                        <!-- TABBED MENU -->

                        <div id="tabs" class="tabs">
                            <nav>
                                <ul>
                                    <li><a href="#section-1"><i class='bx bxs-user-circle'></i><span>Admin</span></a>
                                    </li>
                                    <li><a href="#section-2"><i class='bx bxs-user'></i><span>Regular</span></a></li>
                                    <li><a href="#section-3"><i class='bx bxs-user-account'></i><span>Guest</span></a>
                                    </li>
                                </ul>
                            </nav>

                            <div class="content">

                                <!-- ADMIN TABLE -->
                                <section id="section-1">

                                    <table>
                                        <thead>
                                            <tr>
                                                <th scope="col">Admin ID</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Date Created</th>
                                                <th scope="col">Date Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td data-label="Admin ID">Sample</td>
                                                <td data-label="Username">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td scope="row" data-label="Admin ID">Sample</td>
                                                <td data-label="Username">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td scope="row" data-label="Admin ID">Sample</td>
                                                <td data-label="Username">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td scope="row" data-label="Admin ID">Sample</td>
                                                <td data-label="Username">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </section>

                                <!-- REGULAR CUSTOMER TABLE -->
                                <section id="section-2">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Adress</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Date Created</th>
                                                <th scope="col">Date Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td data-label="ID">Sample</td>
                                                <td data-label="Customer Name">Sample</td>
                                                <td data-label="Address">Sample</td>
                                                <td data-label="Contact">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">Sample</td>
                                                <td data-label="Customer Name">Sample</td>
                                                <td data-label="Address">Sample</td>
                                                <td data-label="Contact">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">Sample</td>
                                                <td data-label="Customer Name">Sample</td>
                                                <td data-label="Address">Sample</td>
                                                <td data-label="Contact">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">Sample</td>
                                                <td data-label="Customer Name">Sample</td>
                                                <td data-label="Address">Sample</td>
                                                <td data-label="Contact">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>

                                <!-- GUEST CUSTOMER TABLE -->
                                <section id="section-3">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Adress</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Date Created</th>
                                                <th scope="col">Date Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td data-label="ID">Sample</td>
                                                <td data-label="Customer Name">Sample</td>
                                                <td data-label="Address">Sample</td>
                                                <td data-label="Contact">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">Sample</td>
                                                <td data-label="Customer Name">Sample</td>
                                                <td data-label="Address">Sample</td>
                                                <td data-label="Contact">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">Sample</td>
                                                <td data-label="Customer Name">Sample</td>
                                                <td data-label="Address">Sample</td>
                                                <td data-label="Contact">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                            <tr>
                                                <td data-label="ID">Sample</td>
                                                <td data-label="Customer Name">Sample</td>
                                                <td data-label="Address">Sample</td>
                                                <td data-label="Contact">Sample</td>
                                                <td data-label="Date Created">Sample</td>
                                                <td data-label="Date Updated">Sample</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>

                            </div> <!-- END FOR TABBED CONTENT -->
                        </div> <!-- END OF TABBED -->
                    </div> <!-- END TABBED CONTAINER -->

                    <script src="js/tabbed.js"></script>
                    <script> new CBPFWTabs(document.getElementById('tabs')); </script>

                </div> <!-- END OF CONTAINER FLUID -->

            </div> <!-- END OF CONTAINER -->

        </div> <!-- END OF DASHBOARD CONTENT -->

    </div> <!-- END OF DASHBOARD APP DIV -->

    </div> <!-- END OF DASHBOARD SIDEBAR DIV -->

</body>

</html>