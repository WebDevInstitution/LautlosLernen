<?php
include './models/dashboardModel.php';

class dashboardRepository extends AbstractRepository {
    public function __construct($database) {
        parent::__construct($database);
    }

    // Model erstellen
    private function createdashboardFromData($data) {
        $dashboard = new dashboardModel();
        $dashboard->setdashboardId($data['id']);
        $dashboard->setUserId($data['user_id']);
        $dashboard->setDatum($data['datum']);
        $dashboard->setRichtigeAntworten($data['richtige_antworten']);
        $dashboard->setFalscheAntworten($data['falsche_antworten']);
        return $dashboard;
    }

    public function getdashboard($id){
        //aus DB abrufen
        $sql = 'select * from dashboard WHERE user_id = ' . $id;
        $data = $this->database->query($sql);
        $result = [];
        //ins Model übertragen
        foreach($data as $row) {
            $result[] = $this->createdashboardFromData($row);
        }
        return $result;
    }

    public function getALL(){
        //aus DB abrufen
        $sql = 'select * from dashboard';
        $data = $this->database->query($sql);
        $result = [];
        //ins Model übertragen
        foreach($data as $row) {
            $result[] = $this->createdashboardFromData($row);
        }
        return $result;
    }
}
