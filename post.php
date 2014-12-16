<?php
$title = "Blog | Posts";
$styleFile = "styles/style.css";
$scriptFile = "scripts/script.js";
require "inc/struct.php";

$id = (int)$_GET['id'];
$post = $db->getPostById($id);
$db->viewPost($id);
$views = $db->getPostViews($id);


getHeader($post['title']);


if($post != null){
    echo '<div class="post">';
    echo '<div class="date clear">' . date('d.m.Y H:i', $post['time']) . '</div>';
    echo '<h3 class="postTitle">' . $post['title'] . '</h3>';
    echo '<div class="postContent">' . nl2br($post['text']) . '</div>';
    echo '<div class="tags">Tags: ';
    $tags = explode(',', $post['tags']);
    for ($i = 0; $i < count($tags); $i++) {
        $tag = trim($tags[$i]);
        echo '<a class="tag" href="' . getSearchUrl("index.php?tag=" . $tag) . '">#' . $tag . ' </a>';
    }
    echo '</div>';
    echo '<div>Views: '.$views.'</div>';
    echo '</div>';

}else{
    echo "<p class='error'>Post not found.</p>";
}

getFooter();

?>