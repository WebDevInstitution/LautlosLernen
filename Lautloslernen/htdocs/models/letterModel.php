<?php
class LetterModel {
    private $letter_id;
    private $letter;
    private $GebärdenBild;
    private $BuchstabenBild;
    private $Teachable;

    public function getLetter_id() {
        return $this->letter_id;
    }

    public function setLetter_id($letter_id) {
        $this->letter_id = $letter_id;
    }

    public function getLetter() {
        return $this->letter;
    }

    public function setLetter($letter) {
        $this->letter = $letter;
    }

    public function getGebärdenBild() {
        return $this->GebärdenBild;
    }

    public function setGebärdenBild($GebärdenBild) {
        $this->GebärdenBild = $GebärdenBild;
    }

    public function getBuchstabenBild() {
        return $this->BuchstabenBild;
    }

    public function setBuchstabenBild($BuchstabenBild) {
        $this->BuchstabenBild = $BuchstabenBild;
    }

    public function isTeachable() {
        return $this->Teachable;
    }

    public function setTeachable($Teachable) {
        $this->Teachable = $Teachable;
    }
}

