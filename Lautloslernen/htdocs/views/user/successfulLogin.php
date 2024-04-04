<?php 
if($_SESSION['isLoggin']== true){
    echo('<h1>Sie sind jetzt eingeloggt. Jetzt kannst du mit dem Lernen beginnen!');
    ?>
    <?php
}
else{
    echo('<h1>Passwort oder Username falsch!!!');
    ?>
    <a href="http://localhost:8080">Home </a> </h1></br>
    <?php
}
