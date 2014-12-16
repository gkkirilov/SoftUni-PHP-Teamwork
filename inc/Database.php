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
    public function getCountAllPosts()
    {
        $query = $this->dbConnection->query('SELECT * FROM `posts`');
        return $query->num_rows;
    }

    public function searchByTags($tags, $start = false, $show = false)
    {
        $limit = "";
        $posts = array();
        if ($start !== false && $show !== false) {
            $limit = " limit " . $start . ", " . $show;
        }
        $tags = explode(" ",$tags);
        foreach($tags as $tag){
            $tag = trim($tag);
            if(isset($where)){
                $where .= " OR LOWER(`tags`) LIKE  LOWER ('%" . $tag . "%')";
            }else{
                $where = "WHERE LOWER(`tags`) LIKE  LOWER ('%" . $tag . "%')";
            }
        }
        $sql = "SELECT * FROM `posts` ".$where." ORDER BY time desc " . $limit;
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

    public function getPostViews($id)
    {
        $query = $this->dbConnection->query('SELECT `views` FROM  `posts` WHERE `id` = ' . $id);
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
        if ($id <= 0) {
            return null;
        }
        $query = $this->dbConnection->query('SELECT * FROM `posts` WHERE `id` = ' . $id . ' limit 0,1');
        return $query->fetch_assoc();
    }

    public function getMostPopularTags($count = 5)
    {
        $temp = array();
        $query = $this->dbConnection->query('SELECT `tags` FROM `posts`');
        while ($row = $query->fetch_assoc()) {
            array_push($temp, $row['tags']);
        }

        $tags = array();
        for ($i = 0; $i < count($temp); $i++) {
            $tempTags = explode(',', $temp[$i]);
            for ($j = 0; $j < count($tempTags); $j++) {
                $tag = trim($tempTags[$j]);
                array_push($tags, $tag);
            }
        }

        $tags = array_count_values($tags);
        arsort($tags);

        $tags = array_slice($tags, 0, $count, true);

        return $tags;

    }


    public function addPostComment($id, $name, $email, $comment){
        $name = $this->dbConnection->real_escape_string($name);
        $email = $this->dbConnection->real_escape_string($email);
        $comment = $this->dbConnection->real_escape_string($comment);
        $this->dbConnection->query('INSERT INTO `post_comments`(`postId`,`name`,`email`,`comment`,`time`) VALUES ('.$id.',"'.$name.'","'.$email.'","'.$comment.'", '.time().')  ');
        if($this->dbConnection->error){
            return false;
        }
        return true;
    }

    public function getPostCommentsById($id, $start = false, $show = false){
        $limit = "";
        $comments = array();
        if ($start !== false && $show !== false) {
            $limit = " limit " . $start . ", " . $show;
        }
        $query = $this->dbConnection->query('SELECT * FROM `post_comments` WHERE `postId` = '.$id.' ORDER BY `time` desc '.$limit);
//        echo $this->dbConnection->error;
        while($row = $query->fetch_assoc()){
            $comments[] = $row;
        }
        return $comments;
    }

    public function getCountPostCommentsById($id){
        $query = $this->dbConnection->query('SELECT * FROM `post_comments` WHERE `postId` = '.$id);
        return $query->num_rows;
    }

    public function updatePostById($id,$title, $text, $tags)
    {
        $title = $this->dbConnection->real_escape_string($title);
        $text = $this->dbConnection->real_escape_string($text);
        $tags = $this->dbConnection->real_escape_string($tags);
        $this->dbConnection->query('UPDATE `posts` set `title` = "'.$title.'", `text` = "'.$text.'", `tags` = "'.$tags.'" WHERE `id` = "'.$id.'"');
    }
}