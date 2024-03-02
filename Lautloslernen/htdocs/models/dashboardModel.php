<?php
class dashboardModel {
    private $Dashbord_id;
    private $user_id;
    private $datum;
    private $buchstabe;
    private $richtige_antworten;
    private $falsche_antworten;

    public function getDashbord_id() {
        return $this->Dashbord_id;
    }

    public function setDashbord_id($Dashbord_id) {
        $this->Dashbord_id = $Dashbord_id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function getDatum() {
        return $this->datum;
    }

    public function setDatum($datum) {
        $this->datum = $datum;
    }

    public function getBuchstabe() {
        return $this->buchstabe;
    }

    public function setBuchstabe($buchstabe) {
        $this->buchstabe = $buchstabe;
    }

    public function getRichtige_antworten() {
        return $this->richtige_antworten;
    }

    public function setRichtige_antworten($richtige_antworten) {
        $this->richtige_antworten = $richtige_antworten;
    }

    public function getFalsche_antworten() {
        return $this->falsche_antworten;
    }

    public function setFalsche_antworten($falsche_antworten) {
        $this->falsche_antworten = $falsche_antworten;
    }
}
