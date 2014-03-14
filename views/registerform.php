<div class="error_messages">
    <?php
        if (isset($register)) {
            if (!empty($register->errorMessages)) {
                foreach ($register->errorMessages as $error) {
                    echo '<p class="error_message">'.$error.'</p>';
                }
            } elseif (!empty($register->message)) {
                echo '<p class="messages">'.$register->message.'</p>';
            }
        }
    ?>
</div>
<form action="register.php" method="post" name="registerform" id="register">
    <div class="form_container">
        <div class="form_title">Nýskráning</div>
        <div class="form_inputs">
            <label for="email" class="form_label">Tölvupóstfang</label>
            <input type="email" name="email" id="email_input" class="form_input">
        </div>
        <div class="form_inputs">
            <label for="password" class="form_label">Lykilorð</label>
            <input type="password" name="password" id="password_input" class="form_input">
        </div>
    </div>
    <input type="submit" name="register" class="submit_form" value="Nýskrá">
    <a href="index.php">Til baka á forsíðu</a>
  
</form>
