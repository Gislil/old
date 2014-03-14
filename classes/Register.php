<?php
class Register
{
    public $errorMessages = array();

    public $message;

    public function __construct()
    {
        if (isset($_POST['register'])) {
            $this->register();
        }
    }

    private function register()
    {
        // Validate the user input
        $email = $_POST['email'];
        $passw = $_POST['password'];
        if (empty($email)){
            $this->errorMessages[] = 'Tölvupóstfang vantar';
        } elseif (strlen($email) > 64) {
            $this->errorMessages[] = 'Tölvupóstfang má ekki vera lengra en 64 stafir';
        } elseif (!preg_match('/.*@.*\..*/', $email)) {
            $this->errorMessages[] = 'Tölvupóstfang virðist ekki vera gilt';
        } elseif (empty($passw)) {
            $this->errorMessages[] = 'Lykilorð vantar';
        } elseif (strlen($passw) < 8) {
            $this->errorMessages[] = 'Lykilorð er of stutt';
        } else {

            // create the database connection
            $db;
            try {
                $db = new PDO('mysql:host='.DB_HOST.';charset=utf8', DB_USER, DB_PASS);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                $this->errorMessages[] = 'Connection failed: ' . $e->getMessage();
            }

            // Check if email is already registered
            $stm = $db->prepare("SELECT * FROM orku_users
                                 WHERE email = :email");
            $stm->bindParam(':email', $email, PDO::PARAM_STR);
            $stm->execute();
	    
            if ($stm->rowCount() == 1) {
                $this->errorMessages[] = 'Tölvupóstfang er þegar skráð';
                // TODO: make way to reset password
            } else {
                // insert the userinfo into the database
                try {
                    // TODO: Hash the password for security
        		    //attempt to hash:
        		    $hashPassw = password_hash($passw, PASSW_BCRYPT);
        		    if ($hashPassw == false) {
            			$this->errorMessages[] = 'hashing failed';
                        return;
        		    } 
                    $stm = $db->prepare("INSERT INTO orku_users
                                         (user_email, user_password_hash)
                                         VALUES (:email, :password)");
                    $stm->bindParam(':email', $email, PDO::PARAM_STR);
                    $stm->bindParam(':password',$hashPassw, PDO::PARAM_STR);
                    $stm->execute();
                    $this->message = 'Skráning tókst.';
                } catch (PDOException $e) {
                    $this->errorMessages[] = 'Registering user failed: ' . $e->getMessage();
                }
            }
        }
    }
}
