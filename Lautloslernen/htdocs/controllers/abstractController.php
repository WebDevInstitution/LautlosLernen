<?php

abstract class AbstractController {
    public $view;
    public $database;

    public function __construct($view, $database) {
        $this->view = $view;
        $this->database = $database;
    }
}