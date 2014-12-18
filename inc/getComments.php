<?php
require "Database.php";
$db = new Database();

$id = (int)$_GET['id'];
$page = (int)$_GET['page'];
$show = (int)$_GET['show'];

$start = ($page-1) * $show;
$result = $db->getPostCommentsById($id,$start,$show);
foreach($result as $row){
    $result["name"] = htmlspecialchars($row['name']);
    $result["comment"] = htmlspecialchars($row['comment']);
}
echo json_encode($result);