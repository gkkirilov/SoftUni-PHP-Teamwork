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
            <section id="add-comment-section">
                <form action="" method="post" id="leave-comment">
                    <h2 id="leave-comment-title">Leave a Reply</h2>
                    <h5 id="leave-comment-required">Required fields are marked *</h5>
                    <label for="nicknameInput"><span class="leave-comment-label">Nickname*:</span>
                        <input type="text" id="nicknameInput" class="leave-comment-input"
                               value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>" name="name" />
                    </label>
                    <label for="emailInput"><span class="leave-comment-label">Email:</span>
                        <input type="text" id="emailInput"  class="leave-comment-input"
                               value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" name="email" />
                    </label>
                    <label for="commentTextarea"><span class="leave-comment-label">Comment*:</span>
                        <textarea name="comment"  class="leave-comment-input"
                                  id="commentTextarea" ><?= isset($comment) ? $comment : ''?></textarea>
                    </label>
                    <label for="captcha">
                        <img src="captcha.php" alt="captcha" id="captcha"/>
                        <input type="text" name="captcha" id="captcha-input" placeholder="Enter the code"/>
                    </label>
                    <input type="hidden" name="commentForm"/>
                    <input type="submit" value="Add comment" id="add-comment" />
                </form>
            </section>
        </div>
        <div class="comments">
            <?php
                if(count($comments) == 0){
                    echo '<p>No data.</p>';
                }else{
                    foreach($comments as $comment){
                        echo ('<span class="comment-date">'.date("d.m.Y H:i",$comment['time']).'</span><br/>');
                        echo ('<span class="comment-name">'.$comment['name'].'</span><br/>');
                        echo ('<span class="comment-text">'.nl2br($comment['comment']).'</span><br/><br/>');
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