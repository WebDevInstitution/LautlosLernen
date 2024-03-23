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
        $dashboardRepository = new dashboardRepository($this->database);
        $letterToGuess = $_POST['letterToGuess'];
        $date = date("Y-m-d");
        echo "letterToGuess: $letterToGuess <br>";
        $userGuess = $_POST["userGuess"];
        echo "userGuess: $userGuess <br>";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Überprüfen, ob der POST-Parameter 'userGuess' vorhanden ist
            if (isset($_POST["userGuess"])) {

                // Wert von 'userGuess' aus dem POST-Parameter erhalten
                $userGuess = $_POST["userGuess"];
                echo "letterToGuess: $letterToGuess <br>";
                echo "userGuess: $userGuess <br>";
                if ($userGuess == $letterToGuess){
                    $dashboardRepository->incrementCorrectAnswer($_SESSION["UserID"], $letterToGuess, $date);
                } else {
                    $dashboardRepository->incrementWrongAnswer($_SESSION["UserID"], $letterToGuess, $date);
                }
                
            } else {
                // Falls 'userGuess' nicht im POST-Parameter vorhanden ist, geben Sie einen Fehler zurück
                http_response_code(400); // Bad Request
                echo "Fehler: Der POST-Parameter 'userGuess' fehlt.";
            }
        } else {
            // Falls die Anfrage keine POST-Anfrage ist, geben Sie einen Fehler zurück
            http_response_code(405); // Method Not Allowed
            echo "Fehler: Nur POST-Anfragen sind erlaubt.";
        }
        $this->getNextLetterAction();
        $this->view->setView("views/learning/default.php");
    }

}