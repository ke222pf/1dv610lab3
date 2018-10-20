<?php

namespace model;
class ConnectToDb {
    
    public function createConnection () {
        include('DataBaseKeys.php');
        $servername = DB_SERVERNAME;
        $dbName = DB_DBNAME;
        $username = DB_NAME;
        $password = DB_PASS;
        // $servername = "localhost";
        // $dbName = "id7092621_lab2";
        // $username = "id7092621_karl";
        // $password = "123123";
        try {
            return new \PDO("mysql:host=$servername;dbname=$dbName;", $username, $password);
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
    }
  }
}