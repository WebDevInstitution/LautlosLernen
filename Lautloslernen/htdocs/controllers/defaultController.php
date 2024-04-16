<?php

class DefaultController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction() {
        // leer, da keine Aktion       
    }
    public function impressumAction() {
        // leer, da keine Aktion
    }    
}
