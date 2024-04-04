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
        `Passwort` varchar(255) NOT NULL,
        `Email` varchar(70) NOT NULL
        );
    ";
    $this->database->query($sql);
}

public function createTableDashbord(){

    //SQL um die Tabelle Dashboard zu erstellen
    $sql= "
    CREATE TABLE Dashboard (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        datum DATE,
        buchstabe CHAR(1),
        richtige_antworten INT,
        falsche_antworten INT,
        FOREIGN KEY (user_id) REFERENCES User(UserID)
        );
    ";
    $this->database->query($sql);
    
}

public function createTableAlphabet(){
    $sql="
    CREATE TABLE Letters (
        letter_id INT AUTO_INCREMENT PRIMARY KEY,
        letter CHAR(1) NOT NULL,
        GebärdenBild VARCHAR(255), -- Pfad zum Bild für die Gebärde
        BuchstabenBild VARCHAR(255), -- Pfad zum Bild für den Buchstaben
        Teachable BOOLEAN -- Ob der Buchstabe lehrbar ist oder nicht
    );
    ";

    $this->database->query($sql);
}

public function insertIntoLetters(){
    $sql = "
    INSERT INTO Letters (letter, GebärdenBild, BuchstabenBild, Teachable) VALUES
    ('A', '/img/Gebärden/a.svg', 'https://cdn-icons-png.flaticon.com/128/9313/9313195.png', 1),
    ('B', '/img/Gebärden/b.svg', 'https://cdn-icons-png.flaticon.com/128/9326/9326434.png', 0),
    ('C', '/img/Gebärden/c.svg', 'https://cdn-icons-png.flaticon.com/128/3665/3665923.png', 1),
    ('D', '/img/Gebärden/d.svg', 'https://cdn-icons-png.flaticon.com/128/8142/8142823.png', 0),
    ('E', '/img/Gebärden/e.svg', 'https://cdn-icons-png.flaticon.com/128/11859/11859275.png', 0),
    ('F', '/img/Gebärden/f.svg', 'https://cdn-icons-png.flaticon.com/128/3665/3665934.png', 0),
    ('G', '/img/Gebärden/g.svg', 'https://cdn-icons-png.flaticon.com/128/9605/9605277.png', 0),
    ('H', '/img/Gebärden/h.svg', 'https://cdn-icons-png.flaticon.com/128/3665/3665946.png', 1),
    ('I', '/img/Gebärden/i.svg', 'https://cdn-icons-png.flaticon.com/128/7297/7297848.png', 0),
    ('J', '/img/Gebärden/j.svg', 'https://cdn-icons-png.flaticon.com/128/5379/5379270.png', 1),
    ('K', '/img/Gebärden/k.svg', 'https://cdn-icons-png.flaticon.com/128/5379/5379280.png', 0),
    ('L', '/img/Gebärden/l.svg', 'https://cdn-icons-png.flaticon.com/128/9605/9605282.png', 1),
    ('M', '/img/Gebärden/m.svg', 'https://cdn-icons-png.flaticon.com/128/9326/9326491.png', 1),
    ('N', '/img/Gebärden/n.svg', 'https://cdn-icons-png.flaticon.com/128/8142/8142756.png', 0),
    ('O', '/img/Gebärden/o.svg', 'https://cdn-icons-png.flaticon.com/128/7297/7297944.png', 0),
    ('P', '/img/Gebärden/p.svg', 'https://cdn-icons-png.flaticon.com/128/5540/5540757.png', 0),
    ('Q', '/img/Gebärden/q.svg', 'https://cdn-icons-png.flaticon.com/128/3666/3666003.png', 0),
    ('R', '/img/Gebärden/r.svg', 'https://cdn-icons-png.flaticon.com/128/6819/6819272.png', 0),
    ('S', '/img/Gebärden/s.svg', 'https://cdn-icons-png.flaticon.com/128/8970/8970862.png', 0),
    ('T', '/img/Gebärden/t.svg', 'https://cdn-icons-png.flaticon.com/128/6819/6819288.png', 0),
    ('U', '/img/Gebärden/u.svg', 'https://cdn-icons-png.flaticon.com/128/9037/9037247.png', 1),
    ('V', '/img/Gebärden/v.svg', 'https://cdn-icons-png.flaticon.com/128/9313/9313248.png', 0),
    ('W', '/img/Gebärden/w.svg', 'https://cdn-icons-png.flaticon.com/128/8142/8142804.png', 0),
    ('X', '/img/Gebärden/x.svg', 'https://cdn-icons-png.flaticon.com/128/9037/9037253.png', 0),
    ('Y', '/img/Gebärden/y.svg', 'https://cdn-icons-png.flaticon.com/128/3666/3666233.png', 0),
    ('Z', '/img/Gebärden/z.svg', 'https://cdn-icons-png.flaticon.com/128/7298/7298100.png', 0);
    ";
    $this->database->query($sql);
}


public function dropTables(){
    $sqlDropUser = "DROP TABLE IF EXISTS User;";
    $sqlDropDashbord =  "DROP TABLE IF EXISTS Dashboard;";
    $sqlDropAlphabet = "DROP TABLE IF EXISTS Letters;";
    $this->database->query($sqlDropUser);
    $this->database->query($sqlDropDashbord);
    $this->database->query($sqlDropAlphabet);
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
        $this->dropTables();
        $this->createTableUser();
        $this->createTableDashbord();
        $this->createTableAlphabet();
        $this->insertIntoLetters();
    }
}
}
