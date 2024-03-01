<?php

class dashboardController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    public function defaultAction(){
        $dashboardRepository = new dashboardRepository($this->database);
        $dashboard = $dashboardRepository->getALL();
        $this->view->dashboard = $dashboard;
    }
    

}