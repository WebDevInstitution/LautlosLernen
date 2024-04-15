<?php

class FaqController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction(){
        // Keine Aktionen
    }
}