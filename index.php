<?php
require "inc/Database.php";
$db = new Database();
$title = "Blog | Home";
$styleFile = "styles/style.css";
$scriptFile = "scripts/script.js";
require "inc/header.php";

$posts = $db->getAllPosts();

?>
    <div class="posts">
        <?php
        if (count($posts) > 0) {
            foreach ($posts as $row) {
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
            }
        } else {
            echo '<p>No data</p>';
        }
        ?>
    </div>
<?php

require "inc/Footer.php";