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
}