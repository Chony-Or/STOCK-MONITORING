<?php
'includes/session.php';

// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'dashboard';
// Include and show the requested page
include $page . '.php';

?>