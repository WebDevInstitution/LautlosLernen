
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

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
        $this->letterToGuess = $this->letters[random_int(0, count($this->letters) - 1)];
    }

    private function getDate() {
        return date("Y-m-d");
    }
    
    public function checkAnswer() {
        if (isset($_POST["userGuess"])) {
            $userGuess = $_POST["userGuess"];
            if ($userGuess == $this->letterToGuess){
                $this->dashboardRepo->incrementCorrectAnswer("", $this->letterToGuess, $this->date);
            } else {
                $this->dashboardRepo->incrementWrongAnswer("", $this->letterToGuess, $this->date);
            }
        }
    }
}

$deafultLearning = new defaultLearning();

if (isset($_POST["action"]) && $_POST["action"] === "callCheckAnswerAndGetNewLetter") {
    $deafultLearning->checkAnswerAndGetNewLetter();
}

if (isset($_POST["action"]) && $_POST["action"] === "callGetLetterToGuess") {
    $deafultLearning->checkAnswerAndGetNewLetter();
}

?>

<button type="submit" onclick="callCheckAnswerAndGetNewLetter()">Antowort best&auml;igen</button>
<button type="submit" onclick="callGetLetterToGuess()">Neuer Buchstabe</button>

<script>
    function callCheckAnswerAndGetNewLetter() {
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/views/learning/default.php",
            data: {action: "callCheckAnswerAndGetNewLetter"},
            success:function(html){
                alert(html);
            }
        });
    }

    function callGetLetterToGuess(){
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/views/learning/default.php",
            data: {action: "callGetLetterToGuess"},
            success:function(html){
                alert(html);
            }
        });
    }
</script>

<div id="webcam-container"></div>
<div id="label-container"></div>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
<script type="text/javascript" src="http://localhost:8080/views/learning/teachableMachine.js"></script>
