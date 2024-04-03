// More API functions here:
// https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

// the link to your model provided by Teachable Machine export panel
const URL = "https://teachablemachine.withgoogle.com/models/qAQ5NG5Ve/";

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
    // predict kann ein Bild-, Video- oder Canvas-HTML-Element entgegennehmen
    const prediction = await model.predict(webcam.canvas);
    let highestProbability = 0;
    for (let i = 0; i < maxPredictions; i++) {
        if (prediction[i].probability > highestProbability){
            highestProbability = prediction[i].probability;
            userGuess = prediction[i].className;
        } else if (prediction[i].probability === highestProbability){
            userGuess = "error";
        }
    }

    // userGuess an den Server senden
    await sendUserGuessToServer(userGuess);
}

// JavaScript AJAX-Anfrage
async function sendUserGuessToServer(userGuess) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/../controllers/learningController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Request successfully completed.');
            } else {
                console.error('Error: Request failed with status ' + xhr.status);
            }
        }
    }
    xhr.send("userGuess=" + encodeURIComponent(userGuess));
}
