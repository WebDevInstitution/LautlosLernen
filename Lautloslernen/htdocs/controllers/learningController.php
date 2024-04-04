<?php
include __DIR__ . "/../controllers/abstractController.php";
include_once __DIR__ . "/../Framework/dashboardRepository.php";

class learningController extends AbstractController {

    public function defaultAction(){
        $this->getNextLetterAction();
    }

    public function getNextLetterAction(){
        $LetterRepository = new LetterRepository($this->database);
        $nextLetter = $LetterRepository->getnextLetter();
        $this->view->nextLetter = $nextLetter;
        $this->view->setView("views/learning/default.php");
    } 

    public function checkAnswerAction(){
        $dashboardRepository = new DashboardRepository($this->database);
        $letterToGuess = $_POST['letterToGuess'];
        $date = date("Y-m-d");
        $userGuess = -1;
    
        // Überprüfen, ob das Formular gesendet wurde und ob ein Benutzer-Guess übermittelt wurde
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["predictedLetter"])) {
            $userGuess = $_POST["predictedLetter"];
        }
    
        if ($userGuess == $letterToGuess){
            $dashboardRepository->incrementCorrectAnswer($_SESSION["UserID"], $letterToGuess, $date);
            $lastLetter = $_SESSION['lastShownLetter'];
            $LetterRepository = new LetterRepository($this->database);
            $Letter = $LetterRepository->GetLetter($lastLetter);
            $this->view->Letter = $Letter;
            $this->view->setView("views/learning/rightAnswer.php");

        } else {

            $dashboardRepository->incrementWrongAnswer($_SESSION["UserID"], $letterToGuess, $date);
            $lastLetter = $_SESSION['lastShownLetter'];
            $LetterRepository = new LetterRepository($this->database);
            $Letter = $LetterRepository->GetLetter($lastLetter);
            $this->view->Letter = $Letter;
            $this->view->setView("views/learning/wrongAnswer.php");
        }
        
    } 
}
