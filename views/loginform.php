<div class="error_messages">
    <?php
        if (isset($login) AND !empty($login->errorMessages)) {
            foreach ($login->errorMessages as $error) {
                echo '<p class="error_message">'.$error.'</p>';
            }
        }
    ?>
</div>
<form action="index.php" method="post" name="loginform" id="login">
    <div class="form_container">
        <div class="form_title">Innskráning</div>
        <div class="form_inputs">
            <label for="email" class="form_label">Tölvupóstfang</label>
            <input type="email" name="email" id="email_input" class="form_input">
        </div>
        <div class="form_inputs">
            <label for="password" class="form_label">Lykilorð</label>
            <input type="password" name="password" id="password_input" class="form_input">
        </div>
    </div>
    <input type="submit" name="login" class="submit_form" value="Innskrá">
  
</form>