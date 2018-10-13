<?php

namespace model;

class RegisterUserToDb {

    private $connectToDb;
    private $name;
    private $password;
    private $checkRegister = null;
    private $connect;
    // private $checkRegExist = false;

    public function __construct(\model\ConnectToDb $ctdb) {
        $this->connectToDb = $ctdb;
    }

    public function getUserCredentials($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }

    public function setUpUserToDb() {
        $this->connect = $this->connectToDb->createConnection();
        $mySql = "INSERT INTO users(name, password) VALUES (:name, :password)";
            //insert query goes here
            $setUpUser = $this->connect->prepare($mySql);
            $hash = password_hash($this->password, PASSWORD_BCRYPT);
            $setUpUser->bindParam(':name', $this->name);
            $setUpUser->bindParam(':password', $hash);
            if($setUpUser->execute()) {
                $this->checkRegister = true;
            } else {
                $this->checkRegister = false;
            }
    }
    public function checkIfAlreadyExistingUser() {
        $getUsername = $this->connectToDb->createConnection()->prepare('SELECT id, name, password FROM users WHERE name=:name');
        $getUsername->bindParam(':name', $this->name);
        $getUsername->execute();
        $ifMatch = $getUsername->fetchColumn();
        if($ifMatch) {
            return false;
        } else {
            return true;
        }
    }
    public function checkIfRegistered() {
        return $this->checkRegister;
    }

}