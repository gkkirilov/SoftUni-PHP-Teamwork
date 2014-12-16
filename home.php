<?php
$title = "Blog | Home";
require "inc/struct.php";
getHeader("Blog | Home");
?>
<h3 class="title">Welcome to our blog!</h3>
<?php
    $homePost = array();
    $homePost = $db->getAllPosts(0, 5);
    foreach ($homePost as $post) {
    $title = mb_strlen($post['title']) > 50 ? mb_substr($post['title'],0, 50)."..." : $post['title'];
    $article = mb_strlen($post['text']) > 300 ? mb_substr($post['text'],0, 300)."..." : $post['text'] ;
    echo '<div class="post" > ';
    echo '<div class="date clear" > ' . date('d . m . Y H:i', $post['time']) . ' </div > ';
    echo '<h3 class="postTitle" ><a href = "post.php?id=' . $post['id'] . '" >' . $title . ' </a ></h3 > ';
    echo '<div class="postContent" > ' . nl2br($article) . ' </div > ';
    echo '<div class="tags" > Tags: ';
        $tags = explode(',', $post['tags']);
        for ($i = 0; $i < count($tags); $i++) {
        $tag = trim($tags[$i]);
        echo '<a class="tag" href="' . getSearchUrl("index.php?tag=" . $tag) . '">#' . $tag . ' </a>';
        }
        echo '</div>';
    echo "<div>Views: {$post['views']}</div>";
    echo '</div>';
    }
getFooter();
?>