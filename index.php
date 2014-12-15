<?php
require "inc/Database.php";
$db = new Database();
$title = "Blog | Home";
require "inc/header.php";
require "inc/utils.php";

$posts = array();

if (isset($_GET["tag"])) {
    $tag = strip_tags($_GET["tag"]);
    $posts = $db->searchByTag($tag);
    echo ' <div class="filter" >Posts filtered by tag: ' . $tag . '<a href="index.php">b</a></div > ';
} else {
    $posts = $db->getAllPosts();
}

?>
    <div class="posts">
        <?php
        if (count($posts) > 0) {
            foreach ($posts as $row) {
                $_SESSION['row'.$row['id']] = $row;
                echo '<div class="post" > ';
                echo '<div class="date clear" > ' . date('d . m . Y H:i', strtotime($row['time'])) . ' </div > ';
                echo '<h3 class="postTitle" ><a href = "post.php?id=' . $row['id'] . '" >' . $row['title'] . ' </a ></h3 > ';
                echo '<div class="postContent" > ' . nl2br($row['text']) . ' </div > ';
                echo '<div class="tags" > Tags: ';
                $tags = explode('#', $row['tags']);
                for ($i = 1; $i < count($tags); $i++)
                    echo '<a class="tag" href="' . getSearchUrl($tags[$i]) . '">#' . $tags[$i] . ' </a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No data</p>';
        }
        ?>
    </div>
<?php

require "inc/Footer.php";