<?php
include_once __DIR__ ."/../models/dashboardModel.php";
include_once __DIR__ ."/AbstractRepository.php";

class dashboardRepository extends AbstractRepository {
    public function __construct($database) {
        parent::__construct($database);
    }

    // Model erstellen
    private function createdashboardFromData($data) {
        $dashboard = new dashboardModel();
        $dashboard->setDashbord_id($data['id']);
        $dashboard->setUser_id($data['user_id']);
        $dashboard->setDatum($data['datum']);
        $dashboard->setBuchstabe($data['buchstabe']);
        $dashboard->setRichtige_antworten($data['richtige_antworten']);
        $dashboard->setFalsche_antworten($data['falsche_antworten']);
        return $dashboard;
    }

    //Summiert die Anzahl an Falschen und richtigen Antworten pro Tag und erstellt daraus ein Dashbord
    //Aus den Daten entsteht das Balkendiagramm
    public function getdashboard($id){
        // Datenbankabfrage anpassen, um die Anzahl der richtigen und falschen Antworten pro Datum zu erhalten
        $sql = 'SELECT 
        Null AS id,
        Null AS user_id,
        datum,
        Null AS buchstabe,
        SUM(richtige_antworten) AS richtige_antworten,
        SUM(falsche_antworten) AS falsche_antworten 
        FROM Dashboard 
        WHERE user_id = ' . $id . '
        GROUP BY datum
        ORDER BY datum DESC;'; // Nach Datum absteigend sortieren
        $data = $this->database->query($sql);
        $result = [];
    
        // Verarbeitung der abgerufenen Daten
        foreach($data as $row) {
            $result[] = $this->createdashboardFromData($row);
        }
        return $result;
    }   

    //für die Gesamtantworten
    public function getTotalAnswersByUser($userId) {
        // SQL-Abfrage, um die gesamten richtigen und falschen Antworten für einen bestimmten Benutzer abzurufen
        $sql = "SELECT SUM(richtige_antworten) AS total_correct_answers, SUM(falsche_antworten) AS total_wrong_answers FROM Dashboard WHERE user_id = $userId";
    
        // Ausführung der Abfrage
        $data = $this->database->query($sql);
    
        // Extrahiere die Ergebnisse
        $result = [];

        foreach ($data as $row) {
            $result['total_correct_answers'] = $row['total_correct_answers'];
            $result['total_wrong_answers'] = $row['total_wrong_answers'];
        }
    
        return $result;
    }

    //Für die Übersicht Prozentuale richtige Antworten pro Buchstabe
    public function getPercentageCorrectAnswersByUser($userId) {
        // SQL-Abfrage, um die Anzahl der richtigen und falschen Antworten für jeden Buchstaben des Benutzers abzurufen
        $sql = "SELECT buchstabe, 
                       SUM(richtige_antworten) AS total_correct_answers, 
                       SUM(falsche_antworten) AS total_wrong_answers 
                FROM Dashboard 
                WHERE user_id = $userId 
                GROUP BY buchstabe";
    
        // Ausführung der Abfrage
        $data = $this->database->query($sql);
    
        // Extrahiere die Ergebnisse und berechne den prozentualen Anteil der richtigen Antworten pro Buchstabe
        $result = [];
    
        foreach ($data as $row) {
            $buchstabe = $row['buchstabe'];
            $totalCorrectAnswers = $row['total_correct_answers'];
            $totalWrongAnswers = $row['total_wrong_answers'];
            $totalAnswers = $totalCorrectAnswers + $totalWrongAnswers;
    
            // Berechnen Sie den prozentualen Anteil der richtigen Antworten
            $percentageCorrectAnswers = ($totalAnswers > 0) ? ($totalCorrectAnswers / $totalAnswers) * 100 : 0;
    
            // Fügen Sie den prozentualen Anteil der richtigen Antworten pro Buchstabe zum Ergebnis hinzu
            $result[$buchstabe] = $percentageCorrectAnswers;
        }
    
        return $result;
    }

    //erhöhen der Richtigen Antworten auf der DB für das Dashboard
    //Diese Methoden werden benötigt, um die Werte zu ändern, wenn der User die richtige oder Falsche Antwort abgegeben hat
    public function incrementCorrectAnswer($userId, $letter, $date){
        // Konvertiere den Buchstaben in Großbuchstaben
        $letter = strtoupper($letter);
        
        // Überprüfe, ob bereits ein Eintrag für dieses Datum vorhanden ist
        $existingEntry = $this->getDashboardEntryByDate($userId, $letter, $date);
        
        if ($existingEntry) {
            // Wenn ein Eintrag für dieses Datum vorhanden ist, erhöhe die richtige Antwort um eins
            $sql = "UPDATE Dashboard SET richtige_antworten = richtige_antworten + 1 WHERE user_id = $userId AND buchstabe = '$letter' AND datum = '$date'";
        } else {
            // Wenn kein Eintrag für dieses Datum vorhanden ist, erstelle einen neuen Eintrag
            $sql = "INSERT INTO Dashboard (user_id, buchstabe, richtige_antworten, falsche_antworten, datum) VALUES ($userId, '$letter', 1, 0, '$date')";
        }
        
        // Ausführen der SQL-Abfrage
        $this->database->query($sql);
    }

    //erhöhen der Falschen Antworten auf der DB für das Dashboard
    //Diese Methoden werden benötigt, um die Werte zu ändern, wenn der User die richtige oder Falsche Antwort abgegeben hat
    public function incrementWrongAnswer($userId, $letter, $date){
        // Konvertiere den Buchstaben in Großbuchstaben
        $letter = strtoupper($letter);
        
        // Überprüfe, ob bereits ein Eintrag für dieses Datum vorhanden ist
        $existingEntry = $this->getDashboardEntryByDate($userId, $letter, $date);
        
        if ($existingEntry) {
            // Wenn ein Eintrag für dieses Datum vorhanden ist, erhöhe die falsche Antwort um eins
            $sql = "UPDATE Dashboard SET falsche_antworten = falsche_antworten + 1 WHERE user_id = $userId AND buchstabe = '$letter' AND datum = '$date'";
        } else {
            // Wenn kein Eintrag für dieses Datum vorhanden ist, erstelle einen neuen Eintrag
            $sql = "INSERT INTO Dashboard (user_id, buchstabe, richtige_antworten, falsche_antworten, datum) VALUES ($userId, '$letter', 0, 1, '$date')";
        }
        
        // Ausführen der SQL-Abfrage
        $this->database->query($sql);
    }
    
    //wird für das Hochsetzten der falschen bzw. richtigen Antworten benötig. Mit der Methode kann man herausfinden, ob Einträge vorhanden sind für ein Datum, Buchstabe und User
    private function getDashboardEntryByDate($userId, $letter, $date) {
        // SQL-Abfrage, um nach einem Eintrag für den bestimmten Nutzer, Buchstaben und Datum zu suchen
        $sql = "SELECT * FROM Dashboard WHERE user_id = $userId AND buchstabe = '$letter' AND datum = '$date'";
        
        // Ausführen der SQL-Abfrage
        $data = $this->database->query($sql);
        
        // Rückgabe des gefundenen Eintrags oder NULL, wenn kein Eintrag vorhanden ist
        return $data ? $data[0] : null;
    }
    
    
    
    
}
