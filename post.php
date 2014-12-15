<?php
require "inc/Database.php";
$db = new Database();
$title =  "Blog | Posts";
$styleFile = "styles/style.css";
$scriptFile = "scripts/script.js";
require "inc/header.php";
$posts = $db->getAllPosts();
?>

<?php
session_start();
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$pattern = '/\?id=[0-9]+/';
preg_match_all($pattern, $url, $id);
$id = $id[0][0];
$id = intval(preg_replace('/\?id=/', '', $id));
$row = $_SESSION['row'.$id];

echo '<div class="post">';
echo '<div class="date clear">' . date('d.m.Y H:i', strtotime($row['time'])) . '</div>';
echo '<h3 class="postTitle"><a href="post.php?id=' . $row['id'] . '" >' . $row['title'] . '</a></h3>';
echo '<div class="postContent">' . nl2br($row['text']) . '</div>';
echo '<div class="tags">Tags: ';
$tags = explode('#', $row['tags']);
for ($i = 1; $i < count($tags); $i++)
    echo '<a class="tag" href="javascript:;">#' . $tags[$i] . ' </a>';
echo '</div>';
echo '</div>';
?>

<?php
require "inc/Footer.php";
?>