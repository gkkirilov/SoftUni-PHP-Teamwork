<?php
require "Database.php";
$db = new Database();

$page = (int)$_GET['page'];
$show = (int)$_GET['show'];

$start = ($page-1) * $show;
$result = $db->getAllPosts($start,$show);
echo json_encode($result);