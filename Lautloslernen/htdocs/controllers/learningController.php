<?php
include __DIR__ . "../views/learning/defaut.php";

class learningController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction(){
        $this->getLetterToGuess();
    }

}