<?php

class DefaultController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction() {
        //Wenn Loggin == true dann darf in die Einstellungen gegangen werden
        $_SESSION['isLoggin'] = false;

    }
    public function impressumAction() {
        //leer da keine Aktion
    }

    //Suche
    public function suggestAction() {
        //Render verhinder
        $this->view->disableRendering();
        $carRepository = new CarRepository($this->database);
        $result = [];
        //Eingabe wird in den CarRepository für eine SELECT Abfrage geschickt
        if ($_GET['q'] != '') {
            $result = $carRepository->findByName($_GET['q']);
        }
        //Antwort wird als Json ausgegeben -> Skript.JS
        echo json_encode($result);
    }

    //Wird ausgeführt wenn Registrierungsbutton auf Default gedrückt wird
    public function registrierenAction() {
        //Übenaheme der Daten aus der Default View
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $passwort = $_POST['passwort'];
        $username = $_POST['username'];
        $email = $_POST['email'];

         // Hashen des Passworts
        $hashedPassword = hash('sha256', $passwort);

        //daten werden in die DB geschrieben
        $sql = "INSERT INTO User (UserID, Vorname, Nachname, Passwort, Email, Username)
        VALUES (NULL, '$vorname', '$nachname', '$hashedPassword', '$email', '$username')";
        $this->database->query($sql);

    }
}