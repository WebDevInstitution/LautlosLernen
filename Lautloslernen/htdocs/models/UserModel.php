<?php
class UserModel {
    
    private $id;
    private $Vorname;
    private $Nachename;
    private $email;
    private $password;
    private $username;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getVorname() {
        return $this->Vorname;
    }
    public function setVorname($name) {
        $this->Vorname = $name;
    }
    public function getNachname() {
        return $this->Nachename;
    }
    public function setNachname($name) {
        $this->Nachename = $name;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {

        $this->email = $email;   
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $hashedPassword = md5($password);
        $this->password = $hashedPassword;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;                              
    }
}