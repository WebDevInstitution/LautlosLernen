<?php
//erstellt ein Suchmuster für den spl-Autoloader
function autoloader($className) {
    //Einzubindende Ordner
    $frameworkPath = './framework/';
    $controllerPath = './controllers/';
    //Klassen Pfad erstellen, \\ wird zu / geändert damit der Pfad auf allen Betriebssystemen läuft
    $classPath = $frameworkPath . str_replace('\\', '/', $className) . '.php';
   
    //wenn diese Klasse Existiert soll sie included werden
    if (file_exists($classPath)) {
        include $classPath;
    } else {//Wenn die Klasse nicht im Framework Ordner zufinden ist wird sie im Controller Ordner gesucht und included
        $classPath = $controllerPath . $className . '.php';
        if (file_exists($classPath)) {
            include $classPath;
        }
    }
}
//ausführen des autoloders, wenn jetzt eine Klasse benötigt wird ist ein include nicht mehr von nöten
spl_autoload_register('autoloader');
//Session für globale variablen wird geöffnet
session_start();

// define default fallbacks
const DEFAULT_CONTROLLER = 'default';
const DEFAULT_ACTION = 'default';


// get user input
if(isset($_GET['c'])) {
    $controllerInput = $_GET['c'];     //z.B.car
} else {
    $controllerInput = DEFAULT_CONTROLLER;
}
if(isset($_GET['a'])) {
    $actionInput = $_GET['a'];      //z.B.detaill
} else {
    $actionInput = DEFAULT_ACTION;
}

// create proper names
$controllerFileName = './controllers/'
    . strtolower($controllerInput)
    . 'Controller.php';         //z.B. ./controllers/carController.php
$controllerName = ucfirst(strtolower($controllerInput)) . 'Controller';   //z.B:CarController

$actionFileName = './views/'
    . strtolower($controllerInput)
    . '/'
    . strtolower($actionInput)
    . '.php';       //z.B.  ./views/car/detaill.php
$actionName = strtolower($actionInput) . 'Action';      //z.B. detaillAction


// load controller file z.B.  ./controllers/carController.php
try {

    if (file_exists($controllerFileName)) {
        // include der DB config
        include 'config.php'; 

        //Verbindung zur DB herstellen
        $database = new Database($config);
        $database->connect();

        //erstellen von der import Klase
        //pruefe_tabelle_in_db() prüft ob DB bereits existiert wenn keine Tabellen erstellt, sost werden sie hier erstellt
        //muss nur beim ersten öffen der webseite durchgeführt werden. Danach existiert dbreset() bei bedarf unter setting
        $import = new Import($database);
        $import->pruefe_tabelle_in_db();

        //View initialisieren
        $view = new View();
        $controller = new $controllerName($view, $database);  //z.B:CarController

        //Action prüfen und durchführen
        if (method_exists($controller, $actionName)) {   
            $controller->$actionName();         //ausführen der Action z.B. detaillAction

            //render setzt das viewfileName in der View
            //das Layout wird eingefügt  -> Im Layout wird renderView() aufgerufen -> include des viewFileName

            $view->render($actionFileName);     //z.B.  ./views/car/detaill.php
            
        } else {
            throw new Exception("Action $actionName not found");
        }
    } 

    //Falls kein Controller gefunden wird
    else {
        throw new Exception("Controller file $controllerFileName not found");
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
