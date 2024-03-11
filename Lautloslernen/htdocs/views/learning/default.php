<button type="submit" onclick="checkAnswerAndGetNewLetter()">Antowort best&auml;igen</button>
<button type="submit" onclick="getLetterToUse()">Neuer Buchstabe</button>

<?php
include __DIR__ . "/../../config.php";
include __DIR__ . "/../../Framework/dashboardRepository.php";

class defaultLearning {
    private $dashboardRepo;
    private $date;
    private $letters;
    private $letterToGuess;

    public function __construct() {
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

    private function getLetterToGuess() {
        print("Letter chosen.");
        $this->letterToGuess = $this->letters[random_int(0, count($this->letters) - 1)];
    }

    private function getDate() {
        return date("Y-m-d");
    }
    
    public function checkAnswer() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userGuess = $_POST["userGuess"];
            if ($userGuess == $this->letterToGuess){
                $this->dashboardRepo->incrementCorrectAnswer("", $this->letterToGuess, $this->date);
            } else {
                $this->dashboardRepo->incrementWrongAnswer("", $this->letterToGuess, $this->date);
            }
        }
    }
}
?>

<div id="webcam-container"></div>
<div id="label-container"></div>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
<script type="text/javascript" src="http://localhost:8080/views/learning/teachableMachine.js"></script>
