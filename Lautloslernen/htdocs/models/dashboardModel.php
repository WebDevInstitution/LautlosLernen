<?php
class dashboardModel {
    private $dashboardId;
    private $userId;
    private $Datum;
    private $richtigeAntworten;
    private $falscheAntworten;

    public function getdashboardId() {
        return $this->dashboardId;
    }

    public function setdashboardId($dashboardId) {
        $this->dashboardId = $dashboardId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getDatum() {
        return $this->Datum;
    }

    public function setDatum($Datum) {
        $this->Datum = $Datum;
    }

    public function getRichtigeAntworten() {
        return $this->richtigeAntworten;
    }

    public function setRichtigeAntworten($richtigeAntworten) {
        $this->richtigeAntworten = $richtigeAntworten;
    }

    public function getFalscheAntworten() {
        return $this->falscheAntworten;
    }

    public function setFalscheAntworten($falscheAntworten) {
        $this->falscheAntworten = $falscheAntworten;
    }
}
