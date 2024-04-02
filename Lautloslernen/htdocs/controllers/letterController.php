<?php

class letterController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction(){
        $letterRepository = new letterRepository($this->database);
        $AllLetters = $letterRepository->getALL();
        $this->view->AllLetters = $AllLetters;
    }
}