<br>
<div class="letterTable">
    <?php foreach ($this->AllLetters as $letter => $letters): ?>
        <table>
        <tr>
            <td>
                <img src="<?php echo $letters->getBuchstabenBild(); ?>" alt="Buchstabe A" width="200">
            </td>
            <td>
                <img src="<?php echo $letters->getGebärdenBild(); ?>" alt="Zeichen A" width="200" height="200">
            </td>
        </tr>
    </table>
    <br>
    <?php endforeach; ?>
</div>
