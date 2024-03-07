<?php
include './models/UserModel.php';
 
class UserRepository extends AbstractRepository {
    public function __construct($database) {
        parent::__construct($database);
    }
 
    //Daten in Model üertragen// wird noch nicht genutzt
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
    public function checkPassword($email, $password) {
        // Hashwert des eingegebenen Passworts erstellen
        $hashedPassword = hash('sha256', $password);
        // SQL-Abfrage mit dem gehashten Passwort ausführen
        $sql = "SELECT * FROM User WHERE Passwort = '$hashedPassword' AND Email = '$email'";
        $data = $this->database->query($sql);
        return $data;
    }

    public function userEmailExist($email){
        $sql = "SELECT * FROM User WHERE Email = '$email'";
        $data = $this->database->query($sql);
        if($data == NULL){
            return false;
        }
        return true;
    }
    
}