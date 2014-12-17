<?php
$title = "Blog | Home";
require "inc/struct.php";
$posts = array();

getHeader("Blog | Post");

$postsPerPage = 10;
$pages = 0;

if (isset($_GET["tag"])) {
    $tags = strip_tags($_GET["tag"]);
    $posts = $db->searchByTags($tags);
    $splittedTags = explode(' ',$tags);
    usort($posts, function ($a,$b) use($splittedTags){
        $firstCnt = 0;
        $secondCnt = 0;
        foreach($splittedTags as $row){
            $row = strtolower(trim($row));
            if(preg_match('/'.$row.'/', strtolower($a['tags']))){
                $firstCnt++;
            }
            if(preg_match('/'.$row.'/', strtolower($b['tags']))){
                $secondCnt++;
            }
        }
        return $secondCnt-$firstCnt;
    });
    echo ' <div class="filter" >Posts filtered by tag: ' . $tags . '<a href="posts.php">b</a></div > ';
} else {
    $postsCnt =  $db->getCountAllPosts();
    $pages = ceil($postsCnt/$postsPerPage);
    $posts = $db->getAllPosts(0, $postsPerPage);
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
    <div class="pages">
        <?php
        for($page = 1;$page <= $pages; $page++){
            if($page != 1){
                echo '<a href="javascript: loadPosts('.$page.','.$postsPerPage.','.$pages.');" >'.$page.'</a>';
            }else{
                echo '<span class="pages">'.$page.'</span>';
            }
        }
        ?>
    </div>
<?php

getFooter();