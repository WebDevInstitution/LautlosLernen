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
        if(isset($_POST['vorname']) && isset($_POST['nachname']) && isset($_POST['passwort']) && isset($_POST['username']) && isset($_POST['email'])) {
            $vorname = $_POST['vorname'];
            $nachname = $_POST['nachname'];
            $passwort = $_POST['passwort'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            
            $userRepository = new UserRepository($this->database);
            $check = $userRepository->userEmailExist($email);
            if ($check == TRUE) {
                echo "<script>alert('Dieser Email existiert bereits');</script>";
                $this->view->setview('./views/user/registration.php');
            }
            
            else{
            // Hashen des Passworts
            $hashedPassword = hash('sha256', $passwort);
            // Daten in die Datenbank schreiben
            $sql = "INSERT INTO User (UserID, Vorname, Nachname, Passwort, Email, Username)
                    VALUES (NULL, '$vorname', '$nachname', '$hashedPassword', '$email', '$username')";
            $this->database->query($sql);

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
            } else {
                $_SESSION['isLoggin'] = false;
            } 
        } 
    }
    
    public function logoffAction() {
        $_SESSION['isLoggin'] = false;
    }

}