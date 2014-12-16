<?php
$title = "Blog | Home";
require "inc/struct.php";
$posts = array();

getHeader("Blog | Home");

if (isset($_GET["tag"])) {
    $tag = strip_tags($_GET["tag"]);
    $posts = $db->searchByTags($tag);
    echo ' <div class="filter" >Posts filtered by tag: ' . $tag . '<a href="index.php">b</a></div > ';
} else {
    $posts = $db->getAllPosts();
}
?>
    <div class="posts">
        <?php
        if (count($posts) > 0) {
            foreach ($posts as $row) {
                $title = mb_strlen($row['title']) > 50 ? mb_substr($row['title'],0, 50)."..." : $row['title'];
                $article = mb_strlen($row['text']) > 300 ? mb_substr($row['text'],0, 300)."..." : $row['text'] ;
                echo '<div class="post" > ';
                echo '<div class="date clear" > ' . date('d . m . Y H:i', $row['time']) . ' </div > ';
                echo '<h3 class="postTitle" ><a href = "post.php?id=' . $row['id'] . '" >' . $title . ' </a ></h3 > ';
                echo '<div class="postContent" > ' . nl2br($article) . ' </div > ';
                echo '<div class="tags" > Tags: ';
                $tags = explode(',', $row['tags']);
                for ($i = 0; $i < count($tags); $i++) {
                    $tag = trim($tags[$i]);
                    echo '<a class="tag" href="' . getSearchUrl("index.php?tag=" . $tag) . '">#' . $tag . ' </a>';
                }
                echo '</div>';
                echo "<div>Views: {$row['views']}</div>";
                echo '</div>';

            }
        } else {
            echo '<p>No data</p>';
        }
        ?>
    </div>
<?php

getFooter();