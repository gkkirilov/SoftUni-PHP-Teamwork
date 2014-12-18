<?php
require "Database.php";
$db = new Database();

$id = (int)$_GET['id'];
$page = (int)$_GET['page'];
$show = (int)$_GET['show'];

$start = ($page-1) * $show;
$result = $db->getPostCommentsById($id,$start,$show);
for($i=0;$i < count($result); $i++){
    $result[$i]["name"] = htmlspecialchars($result[$i]['name']);
    $result[$i]["comment"] = htmlspecialchars($result[$i]['comment']);
}
echo json_encode($result);