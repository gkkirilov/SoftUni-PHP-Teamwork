<?php
require "Database.php";
$db = new Database();
$postId = (int)$_GET['postId'];
$vote = 0;
if($_GET['vote'] == "up"){
    $vote = 1;
}elseif($_GET['vote'] == "down") {
    $vote = -1;
}
if($vote != 0){
    $db->votePost($postId, $vote);
}