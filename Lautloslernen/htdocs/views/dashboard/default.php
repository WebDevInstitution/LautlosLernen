<?php foreach ($this->dashboard as $dashboard): ?>
    <table>
        <tr>
            <th>
            <h3>User ID: <?php echo $dashboard->getUserId(); ?></h3>
            <h3>Datum: <?php echo $dashboard->getDatum(); ?></h3>            
            <h3>Richtige Antworten: <?php echo $dashboard->getRichtigeAntworten(); ?></h3>
            <h3>falsche Antworten: <?php echo $dashboard->getFalscheAntworten(); ?></h3>
            </th>  
        </tr>
    </table></br>
    
<?php endforeach; ?>