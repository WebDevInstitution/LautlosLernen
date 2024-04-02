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
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
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
    ('A', '/img/GebärdenBuchstaben/a.png', 'https://cdn-icons-png.flaticon.com/128/9313/9313195.png', 1),
    ('B', '/img/GebärdenBuchstaben/b.png', 'https://cdn-icons-png.flaticon.com/128/9326/9326434.png', 0),
    ('C', '/img/GebärdenBuchstaben/c.png', 'https://cdn-icons-png.flaticon.com/128/3665/3665923.png', 1),
    ('D', '/img/GebärdenBuchstaben/d.png', 'https://cdn-icons-png.flaticon.com/128/8142/8142823.png', 0),
    ('E', '/img/GebärdenBuchstaben/e.png', 'https://cdn-icons-png.flaticon.com/128/11859/11859275.png', 0),
    ('F', '/img/GebärdenBuchstaben/f.png', 'https://cdn-icons-png.flaticon.com/128/3665/3665934.png', 0),
    ('G', '/img/GebärdenBuchstaben/g.png', 'https://cdn-icons-png.flaticon.com/128/9605/9605277.png', 0),
    ('H', '/img/GebärdenBuchstaben/h.png', 'https://cdn-icons-png.flaticon.com/128/3665/3665946.png', 1),
    ('I', '/img/GebärdenBuchstaben/i.png', 'https://cdn-icons-png.flaticon.com/128/7297/7297848.png', 0),
    ('J', '/img/GebärdenBuchstaben/j.png', 'https://cdn-icons-png.flaticon.com/128/5379/5379270.png', 1),
    ('K', '/img/GebärdenBuchstaben/k.png', 'https://cdn-icons-png.flaticon.com/128/5379/5379280.png', 0),
    ('L', '/img/GebärdenBuchstaben/l.png', 'https://cdn-icons-png.flaticon.com/128/9605/9605282.png', 1),
    ('M', '/img/GebärdenBuchstaben/m.png', 'https://cdn-icons-png.flaticon.com/128/9326/9326491.png', 1),
    ('N', '/img/GebärdenBuchstaben/n.png', 'https://cdn-icons-png.flaticon.com/128/8142/8142756.png', 0),
    ('O', '/img/GebärdenBuchstaben/o.png', 'https://cdn-icons-png.flaticon.com/128/7297/7297944.png', 0),
    ('P', '/img/GebärdenBuchstaben/p.png', 'https://cdn-icons-png.flaticon.com/128/5540/5540757.png', 0),
    ('Q', '/img/GebärdenBuchstaben/q.png', 'https://cdn-icons-png.flaticon.com/128/3666/3666003.png', 0),
    ('R', '/img/GebärdenBuchstaben/r.png', 'https://cdn-icons-png.flaticon.com/128/6819/6819272.png', 0),
    ('S', '/img/GebärdenBuchstaben/s.png', 'https://cdn-icons-png.flaticon.com/128/8970/8970862.png', 0),
    ('T', '/img/GebärdenBuchstaben/t.png', 'https://cdn-icons-png.flaticon.com/128/6819/6819288.png', 0),
    ('U', '/img/GebärdenBuchstaben/u.png', 'https://cdn-icons-png.flaticon.com/128/9037/9037247.png', 1),
    ('V', '/img/GebärdenBuchstaben/v.png', 'https://cdn-icons-png.flaticon.com/128/9313/9313248.png', 0),
    ('W', '/img/GebärdenBuchstaben/w.png', 'https://cdn-icons-png.flaticon.com/128/8142/8142804.png', 0),
    ('X', '/img/GebärdenBuchstaben/x.png', 'https://cdn-icons-png.flaticon.com/128/9037/9037253.png', 0),
    ('Y', '/img/GebärdenBuchstaben/y.png', 'https://cdn-icons-png.flaticon.com/128/3666/3666233.png', 0),
    ('Z', '/img/GebärdenBuchstaben/z.png', 'https://cdn-icons-png.flaticon.com/128/7298/7298100.png', 0);
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
