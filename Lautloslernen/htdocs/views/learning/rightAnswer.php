<h3 style="margin-bottom: 10px;">Richtig!</h3>
<br>

<div class="letterTable">
    <?php foreach ($this->Letter as $letter): ?>
        <table style="margin: auto;">
        <tr>
            <td style="text-align: center;">
                <img src="<?php echo $letter->getBuchstabenBild(); ?>" alt="Buchstabe A" width="200">
            </td>
            <td style="text-align: center;">
                <img src="<?php echo $letter->getGebärdenBild(); ?>" alt="Zeichen A" width="200" height="200">
            </td>
        </tr>
    </table><br>
    <?php endforeach; ?>
</div>

<br/>
<form action="/?a=getNextLetter&c=learning" method="post" class="Button">
    <button type="submit" class="button" >weiter lernen</button>
</form>