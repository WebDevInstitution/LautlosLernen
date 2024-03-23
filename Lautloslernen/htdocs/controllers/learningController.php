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
        echo "letterToGuess: $letterToGuess <br>";
    
        // Check if the form is submitted via POST and if the userGuess is set
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userGuess"])) {
            $userGuess = $_POST["userGuess"];
            echo "userGuess: $userGuess <br>";
        } else {
            // Handle the case when userGuess is not set
            $userGuess = ""; // or any default value you prefer
            echo "userGuess: <br>";
        }
    
        echo "letterToGuess: $letterToGuess <br>";
        echo "userGuess: $userGuess <br>";
    
        if ($userGuess == $letterToGuess){
            $dashboardRepository->incrementCorrectAnswer($_SESSION["UserID"], $letterToGuess, $date);
        } else {
            $dashboardRepository->incrementWrongAnswer($_SESSION["UserID"], $letterToGuess, $date);
        }
        
        $this->getNextLetterAction();
        $this->view->setView("views/learning/default.php");
    }    
}
