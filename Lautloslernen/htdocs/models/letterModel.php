<?php
class letterModel {
    private $letter_id;
    private $letter;

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
}

