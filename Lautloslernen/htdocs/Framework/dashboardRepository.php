<?php
include './models/dashboardModel.php';

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

    public function getdashboard($id){
        //aus DB abrufen
        $sql = 'select * from Alphabet_Dashboard WHERE user_id = ' . $id;
        $data = $this->database->query($sql);
        $result = [];
        //ins Model übertragen
        foreach($data as $row) {
            $result[] = $this->createdashboardFromData($row);
        }
        return $result;
    }

    public function getALL(){
        //aus DB abrufen
        $sql = 'select * from Alphabet_Dashboard';
        $data = $this->database->query($sql);
        $result = [];
        //ins Model übertragen
        foreach($data as $row) {
            $result[] = $this->createdashboardFromData($row);
        }
        return $result;
    }

    public function getTotalAnswersByUser($userId) {
        // SQL-Abfrage, um die gesamten richtigen und falschen Antworten für einen bestimmten Benutzer abzurufen
        $sql = "SELECT SUM(richtige_antworten) AS total_correct_answers, SUM(falsche_antworten) AS total_wrong_answers FROM Alphabet_Dashboard WHERE user_id = $userId";
    
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

    public function getTotalAnswersByDay($userId) {
        // SQL-Abfrage, um die gesamten richtigen und falschen Antworten für jeden Tag für einen bestimmten Benutzer abzurufen
        $sql = "SELECT DATE(datum) AS day, SUM(richtige_antworten) AS total_correct_answers, SUM(falsche_antworten) AS total_wrong_answers 
                FROM Alphabet_Dashboard 
                WHERE user_id = $userId 
                GROUP BY DATE(datum)";
        
        // Ausführung der Abfrage
        $data = $this->database->query($sql);
        
        // Extrahiere die Ergebnisse
        $result = [];
        
        foreach ($data as $row) {
            // Speichere die Anzahl der richtigen und falschen Antworten für jeden Tag
            $result[$row['day']]['total_correct_answers'] = $row['total_correct_answers'];
            $result[$row['day']]['total_wrong_answers'] = $row['total_wrong_answers'];
        }
        
        return $result;
    }
    

    public function getPercentageCorrectAnswersByUser($userId) {
        // SQL-Abfrage, um die Anzahl der richtigen und falschen Antworten für jeden Buchstaben des Benutzers abzurufen
        $sql = "SELECT buchstabe, 
                       SUM(richtige_antworten) AS total_correct_answers, 
                       SUM(falsche_antworten) AS total_wrong_answers 
                FROM Alphabet_Dashboard 
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
    
    
}
