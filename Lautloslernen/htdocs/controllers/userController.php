<?php
class UserController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction() {
        //keine default aktion
    }

    //wenn der Login-Button auf der Anmelde Seite gedrückt wird
    public function loginAction() {
        //Variable erst auf false setzen
       // $_SESSION['isLoggin'] = false; 
        //Wenn Username als auch PW gesetzt sind
        if(isset($_POST['benutzername']) && isset($_POST['passwort'])) {
            //UserRepository für die Abfrage öffnen
            $userRepository = new UserRepository($this->database);
            $check = $userRepository->checkPassword($_POST['benutzername'], $_POST['passwort']);
            //Wenn Passwort und Username übereinstimmen wird die Variable auf true gesetzt
            if($check[0]['Passwort'] == $_POST['passwort'] AND $check[0]['Username'] == $_POST['benutzername']) {
                $_SESSION['isLoggin'] = true;
            }
            else {
                $_SESSION['isLoggin'] = false;
            }
        } 
    }

    public function logoffAction() {
        $_SESSION['isLoggin'] = false;
    }



}