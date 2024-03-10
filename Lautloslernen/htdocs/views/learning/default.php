<button type="submit" onclick="checkAnswer()">Antwort best&auml;tigen</button>

<?php
include __DIR__ . "../../config.php";
include __DIR__ . "../../Framework/dashboardRepository.php";

class defaultLearning {
    private $dashboardRepo;
    private $letterToGuess;
    private $date;

    public function __construct() {
        global $config;
        $this->dashboardRepo = new dashboardRepository($config);
        $this->letterToGuess = $this->generateLetterToGuess();
        $this->date = $this->getDate();
    }

    private function generateLetterToGuess() {
        $letters = range('A', 'Z');
        return $letters[random_int(0, count($letters) - 1)]; // TODO: Anpassen
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
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    // the link to your model provided by Teachable Machine export panel
    const URL = "https://teachablemachine.withgoogle.com/models/3G9tWRb1x/";

    let model, webcam, labelContainer, maxPredictions, userGuess;

    window.onload = function() {
        init();
    }

    // Load the image model and setup the webcam
    async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        // load the model and metadata
        // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
        // or files from your local hard drive
        // Note: the pose library adds "tmImage" object to your window (window.tmImage)
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        // Convenience function to setup a webcam
        const flip = true; // whether to flip the webcam
        webcam = new tmImage.Webcam(500, 500, flip); // width, height, flip
        await webcam.setup(); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);

        // append elements to the DOM
        document.getElementById("webcam-container").appendChild(webcam.canvas);
    }

    async function loop() {
        webcam.update(); // update the webcam frame
        await predict();
        window.requestAnimationFrame(loop);
    }

    // run the webcam image through the image model
    async function predict() {
        // predict can take in an image, video or canvas html element
        const prediction = await model.predict(webcam.canvas);
        let highestProbability = 0;
        for (let i = 0; i < maxPredictions; i++) {
            if (prediction[i].probability > highestProbability){
                highestProbability = prediction[i].probability;
                userGuess = prediction[i].className;
            }else if (prediction[i].probability === highestProbability){
                userGuess = "Error. Please try again.";
            }
        }
    }

    // JavaScript AJAX-Anfrage
    function sendUserGuessToServer(userGuess) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "default.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Antwort vom Server verarbeiten
                console.log(xhr.responseText);
            }
        };
        xhr.send("userGuess=" + encodeURIComponent(userGuess));
    }
</script>
