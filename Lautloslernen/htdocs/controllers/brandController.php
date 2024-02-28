<?php

class BrandController extends AbstractController {
    public function __construct($view, $database) {
        parent::__construct($view, $database);
    }

    //alle Marken anzeigen
    public function brandAction() {

        //BrandRepository
        $brandRepository = new BrandRepository($this->database);
        //get Brand Models from Repository; 
        $brands = $brandRepository->getALL();
        // assign data to view
        $this->view->brands = $brands;

    }

    //Detaillseite der Marke anzeigen
    public function detaillAction() {
        //BrandRepository
        $brandRepository = new BrandRepository($this->database);
        //get Brand Models from Repository; 
        $brand = $brandRepository->getBrand($_GET['id']);
        // assign data to view
        $this->view->brand = $brand;
    }
    



}