<h3>Gesamtantworten</h3>
<p>Richtige Antworten: <?php echo $this->totalAnswers['total_correct_answers']; ?></p>
<p>Falsche Antworten: <?php echo $this->totalAnswers['total_wrong_answers']; ?></p>

<h3>Korrekte Antwortquote pro Buchstabe</h3>
<div>
    <?php foreach ($this->percentageCorrectAnswers as $letter => $percentage): ?>
        <?php
        // Interpolieren der Farbe basierend auf dem Prozentsatz
        $hue = ($percentage / 100) * 120; // Farbton von Rot (0) zu Gelb (60) zu Grün (120)
        // Wenn der Prozentsatz 0% ist, sollte die Farbe tief rot sein
        if ($percentage === 0) {
            $backgroundColor = 'rgba(255, 0, 0, 0.2)';
        }
        // Wenn der Prozentsatz 50% ist, sollte die Farbe Gelb sein
        else if ($percentage === 50) {
            $backgroundColor = 'rgba(255, 255, 0, 0.2)';
        }
        // Wenn der Prozentsatz 100% ist, sollte die Farbe grün sein
        else if ($percentage === 100) {
            $backgroundColor = 'rgba(0, 255, 0, 0.2)';
        }
        // Für Werte zwischen 0% und 50%, eine Abstufung von Rot zu Gelb
        else if ($percentage < 50) {
            $red = 255; // Maximale rote Intensität
            $green = round(255 * ($percentage / 50)); // Grün von 0 bis 255 erhöhen
            $backgroundColor = "rgba($red, $green, 0, 0.2)";
        }
        // Für Werte zwischen 50% und 100%, eine Abstufung von Gelb zu Grün
        else {
            $red = round(255 * ((100 - $percentage) / 50)); // Rot von 255 bis 0 verringern
            $green = 255; // Maximale grüne Intensität
            $backgroundColor = "rgba($red, $green, 0, 0.2)";
        }
        ?>
        <div style="display: inline-block; margin-right: 20px; text-align: center; padding: 10px; border-radius: 5px; background-color: <?php echo $backgroundColor; ?>;">
            <p style="margin: 0; font-weight: bold; font-size: 16px;"><?php echo $letter; ?></p>
            <p style="margin: 0;"><?php echo number_format($percentage, 2); ?>%</p>
        </div>
    <?php endforeach; ?>
</div>

<!-- Laden die Chart.js-Bibliothek -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Erstelle ein Canvas-Element für das Balkendiagramm -->
<canvas id="dashboardChart" height="90%"></canvas>

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
                    beginAtZero: true,
                    stepSize: 1,
                    callback: function(value) {
                        return value;
                    }
                }
            }]
        }
    }
});
</script>


