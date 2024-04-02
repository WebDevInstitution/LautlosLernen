<body onload="init()">

<!-- Hier soll der nächste Buchstabe angezeigt werden -->

<div>
    <?php foreach ($this->nextLetter as $letter): ?>
        <h3 style="margin-bottom: 10px;">Zeige diesen Buchstaben:</h3>
        <img src="<?php echo $letter->getBuchstabenBild(); ?>" alt="Buchstabe A" width="200">
    <?php endforeach; ?>
</div>
<br/>

<form action="/?a=getNextLetter&c=learning" method="post">
    <button type="submit" class="button" >neuer Buchstabe</button>
</form>
<br/>

<div id="webcam-container"></div>

<form id="answer-form" action="/?a=checkAnswer&c=learning" method="post">
    <!-- Versteckte Eingabefelder für den höchsten Vorhersagewert und den Buchstaben -->
    <input type="hidden" id="highest-prediction" name="highestPrediction" value="">
    <input type="hidden" id="predicted-letter" name="predictedLetter" value="">
    <input type="hidden" name="letterToGuess" value="<?php echo $letter->getLetter(); ?>">
    <input type="submit" value="Antwort bestätigen" class="button" ><br><br>
</form>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>

<script>
    const URL = "https://teachablemachine.withgoogle.com/models/qAQ5NG5Ve/";

    let model, webcam, maxPredictions;

    async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        const flip = true;
        webcam = new tmImage.Webcam(400, 400, flip);
        await webcam.setup();
        await webcam.play();
        window.requestAnimationFrame(loop);

        document.getElementById("webcam-container").appendChild(webcam.canvas);
    }

    async function loop() {
        webcam.update();
        await predict();
        window.requestAnimationFrame(loop);
    }

    async function predict() {
        const prediction = await model.predict(webcam.canvas);
        let highestPrediction = 0;
        let predictedLetter = '';
        prediction.forEach(pred => {
            if (pred.probability > highestPrediction) {
                highestPrediction = pred.probability;
                predictedLetter = pred.className;
            }
        });
        document.getElementById('highest-prediction').value = highestPrediction.toFixed(2);
        document.getElementById('predicted-letter').value = predictedLetter;
    }

    document.getElementById('answer-form').addEventListener('submit', function(event) {
        // Vorhersage aktualisieren, bevor das Formular abgeschickt wird
        predict();
    });
</script>

</body>
</html>
