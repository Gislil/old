<?php
require_once 'sql/db_login_info.php';
require_once 'classes/Login.php';

$login = new Login();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orkunotkun</title>
    <link rel="stylesheet" href="css/main.css">
    <script src='js/Chart.js'></script>
</head>
<body>
    <div class="content">
        <?php require 'views/page_header.php' ?>
        <?php
            // if the user is not logged in we show the log in form
            if (!$login->isLoggedIn()) {
                require 'views/loginform.php';
            } else { // if the user is logged in we show the main content
                //require 'views/main_view.php';
        		require 'views/main_view.php';
            }
        ?>
    </div>
</body>
</html>
