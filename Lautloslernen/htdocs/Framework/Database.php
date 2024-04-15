<?php

class Database {
    private $config = []; // Das ConfigFile wird im Konstruktor gesetzt
    private $conn; // Verbindung mit der DB

    // Der Konstruktor wird in der index Datei aufgerufen mit dem ConfigFile
    public function __construct($config) {
        $this->config = (object)$config;
    }

    // Wird im indexFile aufgerufen
    public function connect() {
        $this->conn = mysqli_connect(
            $this->config->host,
            $this->config->username,
            $this->config->password,
            $this->config->database
        );
    }
    
    // Ausführen der query
    public function query($sql) {
        $result = mysqli_query($this->conn, $sql); // Senden der SQL Funktion an die DB
    
        if ($result === false) {
            return false; // Fehler bei der Ausführung der Abfrage
        }
    
        if ($result instanceof mysqli_result) { // Richtiges Ergebniss
            // Alle Zeilen werden in einem Array abgespeichert
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $data;   //Ausgeben der Daten
        }

        else {
            // Für erfolgreich ausgeführte Abfragen, die kein SELECT sind
            return true; 
        }
    }
}
