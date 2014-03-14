<?php
require_once 'sql/db_login_info.php';
require_once 'classes/Register.php';
$register = new Register();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orkunotkun</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="content">
        <?php require 'views/page_header.php';
        <?php
            require 'views/registerform.php';
        ?>
    </div>
</body>
</html>