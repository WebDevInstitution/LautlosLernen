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


/* 
    private $dashboardRepo;
    private $date;
    private $letters;
    private $letterToGuess;

    public function __construct($view, $database) {
        parent::__construct($view, $database);
        global $config;
        global $letters;
        $this->dashboardRepo = new dashboardRepository($config);
        $this->date = $this->getDate();
        $this->letters = $letters;
    }

    public function checkAnswerAndGetNewLetter() {
        $this->checkAnswer();
        $this->getLetterToGuess();
    }

    public function getLetterToGuess() {
        $this->letterToGuess = $this->letters[random_int(0, count($this->letters) - 1)];
    }

    private function getDate() {
        return date("Y-m-d");
    }
    
    public function checkAnswer() {
        if (isset($_POST["userGuess"])) {
            $userGuess = $_POST["userGuess"];
            if ($userGuess == $this->letterToGuess){
                $this->dashboardRepo->incrementCorrectAnswer($_SESSION["UserID"], $this->letterToGuess, $this->date);
            } else {
                $this->dashboardRepo->incrementWrongAnswer($_SESSION["UserID"], $this->letterToGuess, $this->date);
            }
        }
    }
} */
/* 
$learningController = new learningController("http://localhost:8080/views/learning/default.php", $config);

if (isset($_POST["action"]) && $_POST["action"] === "callCheckAnswerAndGetNewLetter") {
    $learningController->checkAnswerAndGetNewLetter();
}

if (isset($_POST["action"]) && $_POST["action"] === "callGetLetterToGuess") {
    $learningController->getLetterToGuess();
}
 */