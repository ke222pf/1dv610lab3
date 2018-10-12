<?php

namespace model;

class ConnectToDb {

    public function createConnection () {
        // $servername = "192.168.64.2";
        // $dbName = "lab3";
        // $username = "karl";
        // $password = "password";
        $servername = "localhost";
        $dbName = "id7092621_lab2";
        $username = "id7092621_karl";
        $password = "123123";
        try {
            return new \PDO("mysql:host=$servername;dbname=$dbName;", $username, $password);
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
    }
  }
}