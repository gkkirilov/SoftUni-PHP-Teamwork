<?php
require "struct.php";

if($_SESSION['isLogged'] !== false){
	header('Location: ../index.php');
	exit;
}

$db = new Database();
$id = (int)$_POST['id'];
$postId = (int)$_POST['postId'];
$result = $db->deleteComment($id);
