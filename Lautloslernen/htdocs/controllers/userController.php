<?php
class UserController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction() {
        //keine Aktionen
    }

    public function registrationAction() {
        //keine Aktionen
    }

    //Wird ausgeführt wenn Registrierungsbutton auf Default gedrückt wird
    public function SuccessfulRegistrationAction() {
        // Übernahme der Daten aus dem Formular
        if( isset($_POST['passwort']) && isset($_POST['email'])) {
            $passwort = $_POST['passwort'];
            $email = $_POST['email'];
            
            $userRepository = new UserRepository($this->database);
            $check = $userRepository->userEmailExist($email);
            if ($check == TRUE) {
                $this->view->setview('./views/user/registration.php');
                echo "<script>alert('Diese Email existiert bereits');</script>";
            }
            
            else{
            // Hashen des Passworts
            $hashedPassword = hash('sha256', $passwort);
            // Daten in die Datenbank schreiben
            $sql = "INSERT INTO User (UserID, Passwort, Email)
                    VALUES (NULL, '$hashedPassword', '$email')";
            $this->database->query($sql);
            $this->view->setView("views/user/login.php");
            echo "<script>alert('Registrierung war erfolgreich!');</script>";
            }
        } else {
            // Falls POST-Daten fehlen, entsprechend handhaben
            echo "Fehler: Nicht alle erforderlichen Felder wurden gesendet.";
        }
    }
    
    public function loginAction(){
        //keine Aktionen
    }
        

    //wenn der Login-Button auf der Anmelde Seite gedrückt wird
    public function successfulloginAction() {
        //Wenn Email als auch PW gesetzt sind
        if(isset($_POST['email']) && isset($_POST['passwort'])) {
            //UserRepository für die Abfrage öffnen
            $userRepository = new UserRepository($this->database);
            $check = $userRepository->checkPassword($_POST['email'], $_POST['passwort']);
            $hashedPassword = hash('sha256', $_POST['passwort']);
            //Wenn Passwort und Email übereinstimmen wird die Variable auf true gesetzt
            if(!empty($check) && $check[0]['Passwort'] == $hashedPassword && $check[0]['Email'] == $_POST['email']) {
                $_SESSION['isLoggin'] = true;
                //Speichern der UserID für das Dashbord
                $_SESSION['UserID'] = $check[0]['UserID'];
                $this->view->setView("views/default/default.php");
            } else {
                $_SESSION['isLoggin'] = false;
                echo '<script>alert("Falsches Passwort oder Email");</script>';
                $this->view->setView("views/user/login.php");
            } 
        } 
    }
    
    public function logoffAction() {
        $_SESSION['isLoggin'] = false;
        $this->view->setView("views/default/default.php");
    }

}