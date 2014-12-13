<?php

class Database{
    public $dbConnection;

    public function  __construct(){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "blog";
        $this->dbConnection = @new Mysqli($host, $user, $pass, $db);
        if($this->dbConnection->connect_error){
            die("Database not found");
        }
    }
}