<?php
class Import{

public $database;

//Klasse wird im settingController erstellt für dbreset
//und in der index Datei, um pruefe_tabelle_in_db() aufzurufen, falls keie Tabellen existieren und diese zu erstellen
public function __construct($database) {
    $this->database = $database;
}

//Wird im SettingController bei dbreset() aufgerufen
public function dropTables(){
    $sqlDropAuto = "DROP TABLE IF EXISTS car;";
    $sqlDropMarke =  "DROP TABLE IF EXISTS Brand;";
    $sqlDropUser = "DROP TABLE IF EXISTS User;";
    $this->database->query($sqlDropAuto);
    $this->database->query($sqlDropMarke);
    $this->database->query($sqlDropUser);
}

//wird im SettingController unter dbresetAction() aufgerufen und in pruefe_tabelle_in_db()
public function insertMarken(){

    //SQL um die Tabelle Brand zu erstellen
    $sql = "
    CREATE TABLE `Brand` (
        `MarkenID` INT AUTO_INCREMENT PRIMARY KEY,
        `HSN` VARCHAR(255) NOT NULL,
        `Markenname` VARCHAR(255) NOT NULL,
        `Kurzbezeichnung_HS` VARCHAR(255) NOT NULL,
        `Herkunftsland` VARCHAR(255) NOT NULL,
        `Gruendungsjahr` INT NOT NULL,
        `CEO` VARCHAR(255) NOT NULL,
        `Website` VARCHAR(255) NOT NULL,
        `Video` VARCHAR(255) NOT NULL,
        `LogoPath` VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
    $this->database->query($sql);
    
    //Auslesen der XML Datei
    $xml = simplexml_load_file('./XML/Brand.xml') or die("Error: Cannot create object");

    //Erstellt für jedes XML TAG eine Variable 
    //für jedes Child Item wird dies ausgeführt, also jede Marke in der Markensammlung
    foreach ($xml->children() as $Marke) {
        $HSN = (string) $Marke->HSN;
        $Markenname = (string) $Marke->Markenname;
        $Kurzbezeichnung_HS = (string) $Marke->Kurzbezeichnung_HS;
        $Herkunftsland = (string) $Marke->Herkunftsland;
        $Gruendungsjahr = (int) $Marke->Gruendungsjahr;
        $CEO = (string) $Marke->CEO;
        $Website = (string) $Marke->Website;
        $Video = (string) $Marke->Video;
        $LogoPath = (string) $Marke->LogoPath;
        
        //speichert diese Daten in die DB mit INSERT
        $sql = "INSERT INTO Brand (HSN, Markenname, Kurzbezeichnung_HS, Herkunftsland, Gruendungsjahr, CEO, Website, Video, LogoPath) 
                VALUES ('$HSN', '$Markenname', '$Kurzbezeichnung_HS', '$Herkunftsland', '$Gruendungsjahr', '$CEO', '$Website', '$Video', '$LogoPath')";
        $this->database->query($sql);       
    }
}
 
//wird im SettingController unter dbresetAction() aufgerufen und in pruefe_tabelle_in_db()
public function insertUser(){

    //SQL um die Tabelle User zu erstellen
    $sql = "
    CREATE TABLE `User`(
        `UserID` int(11) AUTO_INCREMENT PRIMARY KEY,
        `Vorname` varchar(50) NOT NULL,
        `Nachname` varchar(50) NOT NULL,
        `Passwort` varchar(50) NOT NULL,
        `Email` varchar(70) NOT NULL,
        `Username` varchar(70) NOT NULL
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $this->database->query($sql);

    //Auslesen der XML Datei
    $xml = simplexml_load_file('./XML/User.xml') or die("Error: Cannot create object");

    //Erstellt für jedes XML TAG eine Variable 
    //für jedes Child Item wird dies ausgeführt, also jeder User in der Usersammlung
    foreach ($xml->children() as $user) {
        $IDUser = (int) $user->IDUser;
        $Vorname = (string) $user->Vorname;
        $Nachname = (string) $user->Nachname;
        $Passwort = (string) $user->Passwort;
        $Email = (string) $user->Email;
        $Username = (string) $user->Username;
     
        //speichert diese Daten in die DB mit INSERT
        $sql = "INSERT INTO User (UserID, Vorname, Nachname, Passwort, Email, Username)
                VALUES ('$IDUser', '$Vorname', '$Nachname', '$Passwort', '$Email', '$Username')";
        $this->database->query($sql);
    }

}

//wird im SettingController unter dbresetAction() aufgerufen und in pruefe_tabelle_in_db()
public function insertFahrzeuge()
{
    //SWL um die Tabelle car zu erstellen
    $sql = "
    CREATE TABLE `car` (
        `AutoID` int(11) AUTO_INCREMENT PRIMARY KEY,
        `MarkenID` int NOT NULL,
        `Name` varchar(255) NOT NULL,
        `PS` int NOT NULL,
        `Preis` decimal(10,2) NOT NULL,
        `Vorbesitzer` varchar(255) NOT NULL,
        `Erstzulassung` date NOT NULL,
        `TSN` varchar(255) NOT NULL,
        `Fahrzeugklasse` varchar(255) NOT NULL,
        `Typ` varchar(255) NOT NULL,
        `Variante` varchar(255) NOT NULL,
        `Version` varchar(255) NOT NULL,
        `BezeinchnungderFahrzeugklasse` varchar(255) NOT NULL,
        `Aufbau` varchar(255) NOT NULL,
        `Schadstoffklasse` varchar(255) NOT NULL,
        `Emissionsklasse` varchar(255) NOT NULL,
        `Kraftstoffart` varchar(255) NOT NULL,
        `NEFZ_innerorts` decimal(5,2) NOT NULL,
        `NEFZ_ausserorts` decimal(5,2) NOT NULL,
        `NEFZ_kombiniert` decimal(5,2) NOT NULL,
        `NEFZ_CO2` int(5) NOT NULL,
        `WLTP_sehrschnell` decimal(5,2) NOT NULL,
        `WLTP_schnell` decimal(5,2) NOT NULL,
        `WLTP_langsam` decimal(5,2) NOT NULL,
        `WLTP_CO2` int(5) NOT NULL,
        `bild` varchar(255) NOT NULL,
        FOREIGN KEY (`MarkenID`) REFERENCES `brand`(`MarkenID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $this->database->query($sql);

    //Auslesen der XML Datei
    $xml = simplexml_load_file('./XML/Car.xml') or die("Error: Cannot create object");

    //Erstellt für jedes XML TAG eine Variable 
    //für jedes Child Item wird dies ausgeführt, also jede car in der carsammlung
    foreach ($xml->children() as $auto) {
        $markenID = (int) $auto->markenID;
        $name = (string) $auto->name;
        $ps = (int) $auto->ps;
        $preis = (float) $auto->preis;
        $vorbesitzer = (string) $auto->vorbesitzer;
        $erstzulassung = (String) $auto->erstzulassung;
        $tsn = (string) $auto->tsn;
        $fahrzeugklasse = (string) $auto->fahrzeugklasse;
        $typ = (string) $auto->typ;
        $variante = (string) $auto->variante;
        $version = (string) $auto->version;
        $bezeichnungderFahrzeugklasse = (string) $auto->artdesaufbaus;
        $aufbau = (string) $auto->artdesaufbaus;
        $schadstoffklasse = (string) $auto->schadstoffklasse;
        $emissionsklasse = (string) $auto->emissionsklasse;
        $kraftstoffart = (string) $auto->kraftstoffart;
        $NEFZ_innerorts = (float) $auto->verbrauch_innerorts;
        $NEFZ_ausserorts = (float) $auto->verbrauch_außerorts;
        $NEFZ_kombiniert = (float) $auto->verbrauch_kombiniert;
        $NEFZ_CO2 = (int) $auto->CO2_Emission_kombiniert;
        $WLTP_sehrschnell = (float) $auto->sehrschnellWLTP;
        $WLTP_schnell = (float) $auto->schnellWLTP;
        $WLTP_langsam = (float) $auto->langsamWLTP;
        $WLTP_CO2 = (int) $auto->CO2_Emission_kombiniert_WLTP;
        $bild = (string) $auto->bild;

        //speichert diese Daten in die DB mit INSERT
        $sql = "INSERT INTO car (MarkenID, Name, PS, Preis, Vorbesitzer, Erstzulassung, TSN, Fahrzeugklasse, Typ, Variante, Version, BezeinchnungderFahrzeugklasse, Aufbau, Schadstoffklasse, Emissionsklasse, Kraftstoffart, NEFZ_innerorts, NEFZ_ausserorts, NEFZ_kombiniert, NEFZ_CO2, WLTP_sehrschnell, WLTP_schnell, WLTP_langsam, WLTP_CO2, bild)
                VALUES ($markenID, '$name', '$ps', '$preis', '$vorbesitzer', '$erstzulassung', '$tsn', '$fahrzeugklasse', '$typ', '$variante', '$version', '$bezeichnungderFahrzeugklasse', '$aufbau', '$schadstoffklasse', '$emissionsklasse', '$kraftstoffart', $NEFZ_innerorts, $NEFZ_ausserorts, $NEFZ_kombiniert, $NEFZ_CO2, $WLTP_sehrschnell, $WLTP_schnell, $WLTP_langsam, $WLTP_CO2, '$bild')";
        $this->database->query($sql);
    }
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
        $this->insertMarken();
        $this->insertFahrzeuge();
        $this->insertUser();
    }
}

}
