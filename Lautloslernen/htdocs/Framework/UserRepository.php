<?php
include './models/UserModel.php';
 
class UserRepository extends AbstractRepository {
    public function __construct($database) {
        parent::__construct($database);
    }
 
    //Daten in Model üertragen
    private function createUserFromData($data) {
        $user = new UserModel();
           
        $user->setId($data['id']);
        $user->setVorname($data['vorname']);
        $user->setNachname($data['nachname']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setUsername($data['username']);
       
 
        return $user;
    }
 
 
    //In der Anmeldung genutzte Daten werden hier von der DB abgefragt
    //SELECT Abfrage guckt nicht nach Groß- Kleinschreibung deswegen spätere erneute überprüfung durch if
    public function checkPassword($user, $password) {
        // Hashwert des eingegebenen Passworts erstellen
        $hashedPassword = hash('sha256', $password);
        // SQL-Abfrage mit dem gehashten Passwort ausführen
        $sql = "SELECT * FROM User WHERE Passwort = '$hashedPassword' AND Username = '$user'";
        $data = $this->database->query($sql);
        return $data;
    }
    
}