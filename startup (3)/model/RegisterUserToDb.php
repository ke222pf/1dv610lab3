<?php

namespace model;

class RegisterUserToDb {

    private $connectToDb;
    private $name;
    private $password;

    public function __construct(\model\ConnectToDb $ctdb) {
        $this->connectToDb = $ctdb;
    }

    public function getUserCredentials($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }

    public function setUpUserToDb() {
        $connect = $this->connectToDb->createConnection();
        $mySql = "INSERT INTO users(name, password) VALUES (:name, :password)";
        $setUpUser = $connect->prepare($mySql);
        $hash = password_hash($this->password, PASSWORD_BCRYPT);
        $setUpUser->bindParam(':name', $this->name);
        $setUpUser->bindParam(':password', $hash);
        if($setUpUser->execute()) {
            $this->checkRegister = true;
        } else {
            $this->checkRegister = false;
        }
    }
}