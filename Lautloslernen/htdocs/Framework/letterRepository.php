<?php
include_once __DIR__ ."/../models/letterModel.php";

class letterRepository extends AbstractRepository {
    public function __construct($database) {
        parent::__construct($database);
    }

    private function createLetterFromData($data) {
        $letter = new LetterModel();
        $letter->setLetter_id($data['letter_id']);
        $letter->setLetter($data['letter']);
        $letter->setGebärdenBild($data['GebärdenBild']); 
        $letter->setBuchstabenBild($data['BuchstabenBild']); 
        $letter->setTeachable((bool) $data['Teachable']); 
        return $letter;
    }
    
    public function getALL(){
        //aus DB abrufen
        $sql = 'select * from letters';
        $data = $this->database->query($sql);
        $result = [];
        //ins Model übertragen
        foreach($data as $row) {
            $result[] = $this->createLetterFromData($row);
        }
        return $result;
    }

    public function getnextLetter(){
        //aus DB abrufen
        $sql = '
        SELECT *
        FROM letters
        WHERE teachable = 1
        ORDER BY RAND() 
        LIMIT 1;
        ';
        $data = $this->database->query($sql);
        $result = [];
        //ins Model übertragen
        foreach($data as $row) {
            $result[] = $this->createLetterFromData($row);
        }
        return $result;
    }
}