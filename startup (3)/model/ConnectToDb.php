<?php

namespace model;

class ConnectToDb {

    public function createConnection () {
        $servername = "192.168.64.2";
        $dbName = "lab3";
        $username = "karl";
        $password = "password";
        try {
            return new \PDO("mysql:host=$servername;dbname=$dbName;", $username, $password);
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
    }
  }
}