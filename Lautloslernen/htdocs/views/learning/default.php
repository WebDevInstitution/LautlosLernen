<script>
    function callCheckAnswerAndGetNewLetter() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost:8080/controllers/learningController.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    xhr.send("action=callCheckAnswerAndGetNewLetter");
                }
            };
        }

        function callGetLetterToGuess() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost:8080/controllers/learningController.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    xhr.send("action=callGetLetterToGuess");
                }
            };
        }
</script>

<div id="webcam-container"></div>
<div id="label-container"></div>

<button type="submit" onclick="callCheckAnswerAndGetNewLetter()">Antowort best&auml;igen</button>
<button type="submit" onclick="callGetLetterToGuess()">Neuer Buchstabe</button>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost:8080/views/learning/teachableMachine.js"></script>
