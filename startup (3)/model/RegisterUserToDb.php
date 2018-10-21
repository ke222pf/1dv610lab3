<?php

namespace model;

class RegisterUserToDb {

    private $connectToDb;
    private $name;
    private $password;
    private $checkRegister = null;
    private $connect;

    public function __construct(\model\ConnectToDb $ctdb) {
        $this->connectToDb = $ctdb;
    }

    public function getUserCredentials($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }

    // insert users credentials to mysql.
    public function setUpUserToDb() {
        $this->connect = $this->connectToDb->createConnection();
        $mySql = "INSERT INTO users(name, password) VALUES (:name, :password)";
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
            return true;
        } else {
            return false;
        }
    }

    
    public function checkIfRegistered() {
        return $this->checkRegister;
    }

}