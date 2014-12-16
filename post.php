<?php
$title = "Blog | Posts";
$styleFile = "styles/style.css";
$scriptFile = "scripts/script.js";
require "inc/struct.php";

$id = (int)$_GET['id'];
$post = $db->getPostById($id);
$db->viewPost($id);
$views = $db->getPostViews($id);

$commentErrors = array();
if(isset($_POST['commentForm'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $comment = trim($_POST['comment']);
    $captcha = trim($_POST['captcha']);
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
//    if(!password_verify($captcha, $_SESSION['captcha']) || strlen($_SESSION['captcha']) == 0){
//        $commentErrors[] = "Wrong validation code.";
//    }
    if(strlen($email) > 0  && !filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 255){
        $commentErrors[] = "Invalid email.";
    }
    if(strlen($name) < 2 || strlen($name) > 50){
        $commentErrors[] = "The nickname must be between 2 and 50 symbols.";
    }
    if(strlen($comment) < 2){
        $commentErrors[] = "The comment is too short.";
    }
    if(!count($commentErrors)){
        $result = $db->addPostComment($id, $name, $email, $comment);
        if(!$result){
            $commentErrors[] = "Database error.";
        }else{
            unset($comment);
        }
    }
}

$comments = $db->getPostCommentsById($id,0,10);
$commentsCnt = $db->getCountPostCommentsById($id);
$commentsPerPage = 10;
$pages = ceil($commentsCnt/$commentsPerPage);


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
    ?>
        <div class="writeComment">
            <?php
                if(count($commentErrors) > 0){
                    foreach($commentErrors as $err){
                        echo '<p class="error">'.$err.'</p>';
                    }
                }
            ?>
            <form action="" method="post">
                <label for="nicknameInput">Nickname:</label>
                <input type="text" id="nicknameInput" value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>" name="name" />
                <label for="emailInput">Email*: </label>
                <input type="text" id="emailInput" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" name="email" />
                <label for="commentTextarea">Comment: </label>
                <textarea name="comment" id="commentTextarea" ><?= isset($comment) ? $comment : ''?></textarea><br/>
                <input type="text" name="captcha" />
                <img src="captcha.php" alt="captcha" />
                <input type="hidden" name="commentForm"/>
                <input type="submit" value="Add comment" />
            </form>
        </div>
        <div class="comments">
            <?php
                if(count($comments) == 0){
                    echo '<p>No data.</p>';
                }else{
                    foreach($comments as $comment){
                        echo date("d.m.Y H:i",$comment['time'])."<br/>";
                        echo $comment['name']."<br/>";
                        echo nl2br($comment['comment'])."<br/><br/>";
                    }
                }
            ?>
        </div>

    <div class="pages">
        <?php
        for($page = 1;$page <= $pages; $page++){
            if($page != 1){
                echo '<a href="javascript: loadPostComments('.$page.','.$id.','.$commentsPerPage.','.$pages.');" >'.$page.'</a> | ';
            }else{
                echo '<span>'.$page.'</span> | ';
            }
        }
        ?>
    </div>
    <?php

}else{
    echo "<p class='error'>Post not found.</p>";
}

getFooter();

?>