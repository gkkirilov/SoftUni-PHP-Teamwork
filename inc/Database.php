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
        $this->dbConnection->set_charset("UTF8");
    }

    public function getAllPosts($start = false, $show = false){
        $limit = "";
        if($start !== false && $show !== false){
            $limit = " limit ".$start.", ".$show;
        }
        $query = $this->dbConnection->query('SELECT * FROM `posts` ORDER BY time desc'.$limit);
        while($row = $query->fetch_assoc()){
            $posts[] = $row;
        }
        return $posts;
    }
}