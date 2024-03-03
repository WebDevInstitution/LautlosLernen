<!-- Zeigen Sie die Gesamtantworten für den aktuellen Benutzer an -->
<h3>Gesamtantworten:</h3>
<p>Richtige Antworten: <?php echo $this->totalAnswers['total_correct_answers']; ?></p>
<p>Falsche Antworten: <?php echo $this->totalAnswers['total_wrong_answers']; ?></p>



<!-- Zeigen Sie die prozentualen richtigen Antworten pro Buchstabe für den aktuellen Benutzer an -->
<h3 style="margin-bottom: 10px;">Prozentuale richtige Antworten pro Buchstabe:</h3>
<div style="overflow-x: auto; white-space: nowrap; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
    <?php foreach ($this->percentageCorrectAnswers as $letter => $percentage): ?>
        <?php
        // Bestimme die Hintergrundfarbe basierend auf dem Prozentsatz
        $backgroundColor = ($percentage >= 50) ? 'rgba(0, 255, 0, ' . ($percentage / 100) . ')' : 'rgba(255, 0, 0, ' . ($percentage / 100) . ')';
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


