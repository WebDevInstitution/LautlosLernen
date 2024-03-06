<?php 
if($_SESSION['isLoggin']== true){
    echo('<h1>Sie sind jetzt eingeloggt. Jetzt kannst du mit dem Lernen beginnen!');
    ?>

    <img style="height: 400px;" src="https://cataas.com/cat/gif"/>
    <?php
}
else{
    echo('<h1>Passwort oder Username falsch!!!');
    ?>
    <a href="http://localhost:8080">Home </a> </h1></br>
    <img style="height: 400px;" src="https://cataas.com/cat/gif"/>
    <?php
}
