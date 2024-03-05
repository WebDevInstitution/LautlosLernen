<?php
class Import{

public $database;

//Klasse wird in der index Datei, um pruefe_tabelle_in_db() aufzurufen, falls keie Tabellen existieren und diese zu erstellen
public function __construct($database) {
    $this->database = $database;
}

 
//wird in pruefe_tabelle_in_db() aufgerufen
public function createTableUser(){

    //SQL um die Tabelle User zu erstellen
    $sql = "
    CREATE TABLE `User`(
        `UserID` int(11) AUTO_INCREMENT PRIMARY KEY,
        `Vorname` varchar(50) NOT NULL,
        `Nachname` varchar(50) NOT NULL,
        `Passwort` varchar(255) NOT NULL,
        `Email` varchar(70) NOT NULL,
        `Username` varchar(70) NOT NULL
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $this->database->query($sql);
}

public function createTableAlphabet_Dashbord(){

    //SQL um die Tabelle Alphabet_Dashboard zu erstellen
    $sql= "
    CREATE TABLE Alphabet_Dashboard (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        datum DATE,
        buchstabe CHAR(1),
        richtige_antworten INT,
        falsche_antworten INT,
        FOREIGN KEY (user_id) REFERENCES User(UserID)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $this->database->query($sql);
    
}

//wird in der index Datei aufgerufen um zu prüfen, ob die Tabellen existieren -> erster aufruf der Webseite
function pruefe_tabelle_in_db() {
    
    //aktivierung des Schemas wwi2022a -> falls die Webseite das erste mal aufgerufen wird
    $sql = "use wwi2022a";
    $this->database->query($sql);

    // SQL-Abfrage, um zu überprüfen, ob die Tabelle existiert
    $sql = "SHOW TABLES";
    $data = $this->database->query($sql);
    if ($data==NULL) {
        $this->createTableUser();
        $this->createTableAlphabet_Dashbord();
    }
}
}
