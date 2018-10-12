<?php
namespace model;

class loginUser {

private $name;
private $password;
private $connectToDb;
private $checkUser;
private $session;

const WRONG_CREDENTIALS = "Wrong name or password";

public function __construct(\model\ConnectToDb $ctdb, \model\Session $s) {
    $this->connectToDb = $ctdb;
    $this->session = $s;
}

    public function getCredentials($name, $password) {
       $this->name = $name;
       $this->password = $password;
    }

    // SOURCE:  https://www.youtube.com/watch?v=bjT5PJn0Mu8
    public function matchLogin() {
        $getConnection = $this->connectToDb->createConnection();
        $getUsername = $getConnection->prepare('SELECT id, name, password FROM users WHERE name=:name');
        $getUsername->bindParam(':name', $this->name);
        $getUsername->execute();
        $matchUser = $getUsername->fetch();
        if($matchUser && password_verify($this->password, $matchUser['password'])) {
            $this->session->getSessionName($this->name);
            $this->checkUser = true;
        } else {
            throw new \Exception(self::WRONG_CREDENTIALS);
            $this->checkUser = false;
        }
    }

    public function isUserLoggedIn() {
        return $this->checkUser;
    }
}
