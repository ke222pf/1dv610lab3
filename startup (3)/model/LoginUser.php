<?php
namespace model;

class loginUser {

private $name;
private $password;
private $connectToDb;
private $checkUser;
private $session;


public function __construct(\model\ConnectToDb $ctdb, \model\Session $s) {
    $this->connectToDb = $ctdb;
    $this->session = $s;
}

    public function setCredentials($name, $password) {
       $this->name = $name;
       $this->password = $password;
    }

    // compare users credentils to mysql
    public function tryLogin() {
        $getConnection = $this->connectToDb->createConnection();
        $getUsername = $getConnection->prepare('SELECT id, name, password FROM users WHERE name=:name');
        $getUsername->bindParam(':name', $this->name);
        $getUsername->execute();
        $matchUser = $getUsername->fetch();
        if($matchUser && password_verify($this->password, $matchUser['password'])) {
            $this->session->setSessionName($this->name);
            $this->checkUser = true;
        } else {
            $this->checkUser = false;
        }
    }

    public function getloggedInStatus() {
        return $this->checkUser;
    }
}
