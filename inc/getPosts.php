<?php
require "Database.php";
$db = new Database();

$page = (int)$_GET['page'];
$show = (int)$_GET['show'];

$start = ($page-1) * $show;
$result = $db->getAllPosts($start,$show);

for($i = 0; $i < count($result); $i++){
    $comments = $db->getCountPostCommentsById($result[$i]['id']);
    $result[$i]["commentsCnt"] = $comments;
}

echo json_encode($result);