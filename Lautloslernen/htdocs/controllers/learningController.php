<?php
include __DIR__ . "/../config.php";
include_once __DIR__ . "/../Framework/dashboardRepository.php";

class learningController extends AbstractController {
    public function defaultAction(){
    }

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
}

$learningController = new learningController("http://localhost:8080/views/learning/default.php", $config);

if (isset($_POST["action"]) && $_POST["action"] === "callCheckAnswerAndGetNewLetter") {
    $learningController->checkAnswerAndGetNewLetter();
}

if (isset($_POST["action"]) && $_POST["action"] === "callGetLetterToGuess") {
    $learningController->getLetterToGuess();
}
