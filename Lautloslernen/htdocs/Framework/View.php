<?php

class View {

    private $_data = [];

    private $canRender = true;

    private $viewFileName;

    // force files
    private $force;
    private $forceview;

    // Die Methode wird aufgerufen, wenn auf eine nicht vorhandene oder nicht öffentliche Eigenschaft zugegriffen wird. 
    // In diesem Fall überprüft sie, ob das gesuchte $key im internen Array  existiert. 
    public function __get($key) {
        if (isset($this->_data[$key])) {
            return $this->_data[$key];
        }
        return null;
    }

    public function __set($key, $value) {
        $this->_data[$key] = $value;
    }

    public function disableRendering() {
        $this->canRender = false;
    }

    // Setzt die View auf eine bestimmte Seite
    public function setView($view){
        $this->force = true;
        $this->forceview = $view;
    }

    // Wird aufgerufen unter index, um die aktuelle Seite anzuzeigen
    public function render($viewFileName) {
        $layoutFileName = './views/layout.php';

        if($this->canRender == false) {
            return;
        }
        
        // Falls mit SetView() eine spezielle Seite angezeigt werden muss!
        if($this->force==true){
            if(file_exists($this->forceview)) {
                $this->viewFileName = $this->forceview;
                include $layoutFileName;
            } else {
                die("view file $this->forceview NOT FOUND");
            }
        }

        // Im Standart Fall wird viewFileName auf die Seite gesetzt, die im Parameter angezeigt wird
        else{
            if(file_exists($layoutFileName)) {
                // Setzt das viewFileName in der Klasse auf den Parameter
                $this->viewFileName = $viewFileName;
                include $layoutFileName;
            } else {
                die("view file $layoutFileName NOT FOUND");
            }
        }
    }

    private function renderView() {
        include $this->viewFileName;
    }
}
