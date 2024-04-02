<!-- Zeigen Sie die Gesamtantworten für den aktuellen Benutzer an -->
<h3>Gesamtantworten:</h3>
<p>Richtige Antworten: <?php echo $this->totalAnswers['total_correct_answers']; ?></p>
<p>Falsche Antworten: <?php echo $this->totalAnswers['total_wrong_answers']; ?></p>



<h3 style="margin-bottom: 10px;">Prozentuale richtige Antworten pro Buchstabe:</h3>
<div style="overflow-x: auto; white-space: nowrap; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
    <?php foreach ($this->percentageCorrectAnswers as $letter => $percentage): ?>
        <?php
        // Interpolieren der Farbe basierend auf dem Prozentsatz
        $hue = ($percentage / 100) * 120; // Farbton von Rot (0) zu Gelb (60) zu Grün (120)
        $backgroundColor = "hsl($hue, 100%, 50%)"; // Sättigung und Helligkeit bleiben konstant
        
        // Wenn der Prozentsatz 0% ist, sollte die Farbe tief rot sein
        if ($percentage === 0) {
            $backgroundColor = 'rgba(255, 0, 0, 1)';
        }
        // Wenn der Prozentsatz 50% ist, sollte die Farbe Gelb sein
        else if ($percentage === 50) {
            $backgroundColor = 'rgba(255, 255, 0, 1)';
        }
        // Wenn der Prozentsatz 100% ist, sollte die Farbe grün sein
        else if ($percentage === 100) {
            $backgroundColor = 'rgba(0, 255, 0, 1)';
        }
        ?>
        <div style="display: inline-block; margin-right: 20px; text-align: center; padding: 10px; border-radius: 5px; background-color: <?php echo $backgroundColor; ?>;">
            <p style="margin: 0; font-weight: bold; font-size: 16px;"><?php echo $letter; ?></p>
            <p style="margin: 0;"><?php echo number_format($percentage, 2); ?>%</p>
        </div>
    <?php endforeach; ?>
</div>





<!-- Laden Sie die Chart.js-Bibliothek -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Erstellen Sie ein Canvas-Element für das Balkendiagramm -->
<canvas id="dashboardChart"></canvas>

<script>
// Daten für das Balkendiagramm vorbereiten
var dates = [];
var correctAnswers = [];
var wrongAnswers = [];

 <?php foreach ($this->dashboard as $dashboard): ?>
    dates.push('<?php echo $dashboard->getDatum(); ?>');
    correctAnswers.push(<?php echo $dashboard->getRichtige_antworten(); ?>);
   wrongAnswers.push(<?php echo $dashboard->getFalsche_antworten(); ?>);
<?php endforeach; ?> 



// Kontext des Canvas-Elements erhalten
var ctx = document.getElementById('dashboardChart').getContext('2d');

// Balkendiagramm erstellen
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dates,
        datasets: [{
            label: 'Richtige Antworten',
            data: correctAnswers,
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Grüne Farbe für richtige Antworten
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }, {
            label: 'Falsche Antworten',
            data: wrongAnswers,
            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Rote Farbe für falsche Antworten
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>


