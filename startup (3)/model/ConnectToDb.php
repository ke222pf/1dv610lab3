<?php

namespace model;

// hidde variables.
require_once('DataBaseKeys.php');

class ConnectToDb {

    // sets up a connection to mysql.
    public function createConnection () {
        $servername = DB_SERVERNAME;
        $dbName = DB_DBNAME;
        $username = DB_NAME;
        $password = DB_PASS;
        
        try {
            return new \PDO("mysql:host=$servername;dbname=$dbName;", $username, $password);
            }
        catch(\PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
    }
  }
}