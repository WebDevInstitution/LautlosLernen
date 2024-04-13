<?php

function autoloader($className) {
    // Einzubindende Ordner
    $frameworkPath = './framework/';
    $controllerPath = './controllers/';
    // Klassenpfad erstellen, '\\' wird zu '/' geändert, damit der Pfad auf allen Betriebssystemen läuft
    $classPath = $frameworkPath . str_replace('\\', '/', $className) . '.php';
   
    // Wenn diese Klasse Existiert soll sie included werden
    if (file_exists($classPath)) {
        include $classPath;
    } else { // Wenn die Klasse nicht im Framework Ordner zufinden ist wird sie im Controller Ordner gesucht und included
        $classPath = $controllerPath . $className . '.php';
        if (file_exists($classPath)) {
            include $classPath;
        }
    }
}
// Ausführen des autoloders, wenn jetzt eine Klasse benötigt wird ist ein include nicht mehr von nöten
spl_autoload_register('autoloader');
// Session für globale variablen wird geöffnet
session_start();

// Setze die Logon-Variable zu Beginn auf false, wenn sie noch nicht gesetzt ist
if (!isset($_SESSION['isLoggin'])) {
    $_SESSION['isLoggin'] = false;
}

if (!isset($_SESSION['lastShownLetter'])) {
    $_SESSION['lastShownLetter'] = '';
}

// define default fallbacks
const DEFAULT_CONTROLLER = 'default';
const DEFAULT_ACTION = 'default';


// get user input
if(isset($_GET['c'])) {
    $controllerInput = $_GET['c'];
} else {
    $controllerInput = DEFAULT_CONTROLLER;
}
if(isset($_GET['a'])) {
    $actionInput = $_GET['a'];
} else {
    $actionInput = DEFAULT_ACTION;
}

// create proper names
$controllerFileName = './controllers/'
    . strtolower($controllerInput)
    . 'Controller.php';
$controllerName = ucfirst(strtolower($controllerInput)) . 'Controller';

$actionFileName = './views/'
    . strtolower($controllerInput)
    . '/'
    . strtolower($actionInput)
    . '.php';
$actionName = strtolower($actionInput) . 'Action';

try {


    if (file_exists($controllerFileName)) {
        // include der DB config
        include 'config.php'; 

        // Verbindung zur DB herstellen
        $database = new Database($config);
        $database->connect();

        // Erstellen von der import Klase
        // pruefe_tabelle_in_db() prüft ob DB bereits existiert wenn keine Tabellen erstellt, sost werden sie hier erstellt
        $import = new Import($database);
        $import->pruefe_tabelle_in_db();

        // View initialisieren
        $view = new View();
        $controller = new $controllerName($view, $database);

        // Action prüfen und durchführen
        if (method_exists($controller, $actionName)) {   
            $controller->$actionName();

            // render setzt das viewfileName in der View
            // das Layout wird eingefügt  -> Im Layout wird renderView() aufgerufen -> include des viewFileName

            $view->render($actionFileName); 
            
        } else {
            throw new Exception("Action $actionName not found");
        }
    } 

    // Falls kein Controller gefunden wird
    else {
        throw new Exception("Controller file $controllerFileName not found");
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
