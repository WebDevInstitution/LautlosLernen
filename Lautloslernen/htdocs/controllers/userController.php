<?php
class UserController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction() {
        //keine Aktionen
    }

    //wenn der Login-Button auf der Anmelde Seite gedrückt wird
    public function loginAction() {

        //Wenn Username als auch PW gesetzt sind
        if(isset($_POST['benutzername']) && isset($_POST['passwort'])) {

            //UserRepository für die Abfrage öffnen
            $userRepository = new UserRepository($this->database);
            $check = $userRepository->checkPassword($_POST['benutzername'], $_POST['passwort']);
            $hashedPassword = hash('sha256', $_POST['passwort']);
            //Wenn Passwort und Username übereinstimmen wird die Variable auf true gesetzt
            if(!empty($check) && $check[0]['Passwort'] == $hashedPassword && $check[0]['Username'] == $_POST['benutzername']) {
                $_SESSION['isLoggin'] = true;
                //Speichern der UserID für das Dashbord
                $_SESSION['UserID'] = $check[0]['UserID'];
                echo($_SESSION['UserID']);
                //Andere Option
                //$user = $userRepository->getActualUser();
                //this->view->user = $user;
            } else {
                $_SESSION['isLoggin'] = false;
            } 
        } 
    }
    
    public function logoffAction() {
        $_SESSION['isLoggin'] = false;
    }

}