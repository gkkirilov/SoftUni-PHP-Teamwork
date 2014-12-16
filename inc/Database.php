<?php

class Database
{
    public $dbConnection;

    public function  __construct()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "blog";
        $this->dbConnection = @new Mysqli($host, $user, $pass, $db);
        if ($this->dbConnection->connect_error) {
            die("Database not found");
        }
        $this->dbConnection->set_charset("UTF8");
    }

    public function getAllPosts($start = false, $show = false)
    {
        $limit = "";
        $posts = array();
        if ($start !== false && $show !== false) {
            $limit = " limit " . $start . ", " . $show;
        }
        $query = $this->dbConnection->query('SELECT * FROM `posts` ORDER BY time desc' . $limit);
        while ($row = $query->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
    }

    public function searchByTag($tag, $start = false, $show = false)
    {
        $limit = "";
        $posts = array();
        if ($start !== false && $show !== false) {
            $limit = " limit " . $start . ", " . $show;
        }

        $sql = "SELECT * FROM `posts` WHERE LOWER(`tags`) LIKE  LOWER ('%" . $tag . "%') ORDER BY time desc " . $limit;
        $query = $this->dbConnection->query($sql);
        while ($row = $query->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
    }

    public function viewPost($id)
    {
        $this->dbConnection->query("UPDATE posts SET `views`=(`views`+1) WHERE `id` = " . $id);
    }

    public function getPostViews($id){
        $query = $this->dbConnection->query('SELECT `views` FROM  `posts` WHERE `id` = '.$id);
        return $query->fetch_assoc()['views'];
    }

    public function getMostViewedPosts($count = 5)
    {
        $query = $this->dbConnection->query('SELECT * FROM `posts` ORDER BY `views` desc limit 0, ' . $count);
        while ($row = $query->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
    }

    public function getPostById($id)
    {
        if($id <= 0){
            return null;
        }
        $query = $this->dbConnection->query('SELECT * FROM `posts` WHERE `id` = '.$id.' limit 0,1');
        return $query->fetch_assoc();
    }
}