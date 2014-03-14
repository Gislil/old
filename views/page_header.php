<header>
    <h1 class='title'>Orkunotkun</h1>
    <div class='header_user'>
        <?php
        if ($login->isLoggedIn()) {
            echo '<p class="userid">Velkomin(n) '.$_SESSION['name'].'</p>';
            echo "<a class='logout_button' href='index.php?logout'>Útskrá</a>";
        }
        ?>
    </div>
</header>