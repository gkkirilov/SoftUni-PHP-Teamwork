<?php
require "Database.php";
require "utils.php";
$db = new Database();

$id = (int)$_POST['id'];
$postId = (int)$_POST['postId'];
$result = $db->deleteComment($id);

echo "post.php?id=$postId";