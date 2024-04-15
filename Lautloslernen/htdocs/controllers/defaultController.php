<?php

class DefaultController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction() {
        // leer, da keine Aktion       
    }
    public function impressumAction() {
        // leer, da keine Aktion
    }

    // Wird ausgeführt wenn Registrierungsbutton auf Default gedrückt wird
    public function registrierenAction() {
        // Übernahme der Daten aus der Default View
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $passwort = $_POST['passwort'];
        $username = $_POST['username'];
        $email = $_POST['email'];
    
        // Hashen des Passworts
        $hashedPassword = hash('sha256', $passwort);
    
        // Daten werden in die DB geschrieben
        $sql = "INSERT INTO User (UserID, Vorname, Nachname, Passwort, Email, Username)
                VALUES (NULL, '$vorname', '$nachname', '$hashedPassword', '$email', '$username')";
        $this->database->query($sql);
    }
}
