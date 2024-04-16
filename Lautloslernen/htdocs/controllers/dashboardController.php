<?php

class dashboardController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction(){
        $dashboardRepository = new dashboardRepository($this->database);
        
        // Gesamtantworten für den aktuellen Benutzer abrufen
        $totalAnswers = $dashboardRepository->getTotalAnswersByUser($_SESSION['UserID']);
        $this->view->totalAnswers = $totalAnswers;

        // Prozentsatz der richtigen Antworten pro Buchstabe für den aktuellen Benutzer abrufen
        $percentageCorrectAnswers = $dashboardRepository->getPercentageCorrectAnswersByUser($_SESSION['UserID']);
        $this->view->percentageCorrectAnswers = $percentageCorrectAnswers;

        // Aktuelle Dashboard-Daten abrufen
        $dashboard = $dashboardRepository->getdashboard($_SESSION['UserID']);
        $this->view->dashboard = $dashboard;
    }
}
