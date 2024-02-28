<?php
include './models/BrandModel.php';
 
class BrandRepository extends AbstractRepository{
    public function __construct($database) {
        parent::__construct($database);
    }
 
    //Models erstellen
    private function createBrandFromData($data) {
        $brand = new BrandModel();
 
        $brand->setMarkenID($data['MarkenID']);
        $brand->setHsn($data['HSN']);
        $brand->setMarkenname($data['Markenname']);
        $brand->setKurzbezeichnung_HS($data['Kurzbezeichnung_HS']);
        $brand->setHerkunftsland($data['Herkunftsland']);
        $brand->setGruendungsjahr($data['Gruendungsjahr']);
        $brand->setCeo($data['CEO']);
        $brand->setWebsite($data['Website']);
        $brand->setVideo($data['Video']);
        $brand->setLogoPath($data['LogoPath']);
 
        return $brand;
    }
 
    //Alle Marken aus DB abrufen
    public function getAll(){
        // get data from a database
        $sql = 'select * from Brand';
        $data = $this->database->query($sql);
        $result = [];
        //Daten aus DB ins Model übertragen
        foreach($data as $row) {
            $result[] = $this->createBrandFromData($row);
        }
        return $result;
    }
 
    //Ausgewählte Marke aus DB abrufen
    public function getBrand($id){
        //aus DB abrufen
        $sql = 'select * from Brand WHERE MarkenID = ' . $id;
        $data = $this->database->query($sql);
        $result = [];
        //ins Model übertragen
        foreach($data as $row) {
            $result[] = $this->createBrandFromData($row);
        }
        return $result;
    }
}