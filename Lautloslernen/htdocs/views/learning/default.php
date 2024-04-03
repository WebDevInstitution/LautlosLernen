<br />
<br />
<div id="webcam-container"></div>
<div id="label-container"></div>

<form action="/?a=getNextLetter&c=learning" method="post">
    <button type="submit">neuer Buchstabe</button>
</form>

<!-- Hier soll der nächste Buchstabe angezeigt werden -->
<h3 style="margin-bottom: 10px;">Zeige diesen Buchstabe:</h3>
<div>
    <?php foreach ($this->nextLetter as $letter): ?>
            <?php echo $letter->getLetter(); ?></p>
        </div>
    <?php endforeach; ?>

</div>

<form action="/?a=checkAnswer&c=learning" method="post">
    <fieldset>
        <!-- Verstecktes Eingabefeld für den Buchstabenwert -->
        <input type="hidden" name="letterToGuess" value="<?php echo $letter->getLetter(); ?>">
        <input type="submit" value="Antwort bestätigen"><br><br>
    </fieldset>
</form>



<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost:8080/views/learning/teachableMachine.js"></script>