<?php
session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] ===  false){
    header("Location: index.php");
}
$title = "Add Post";
$styleFile = "../styles/style.css";
$scriptFile = "../scripts/script.js";
require '../inc/header.php';
require '../inc/Database.php';


    if($_POST){
        $db = new Database();
        $db = $db->dbConnection;
        $artTitle = trim($_POST['title']);
        $article = trim($_POST['article']);
        $artTags = trim($_POST['tags']);
        $errors = array();

        if(mb_strlen($artTitle) <= 1 || mb_strlen($artTitle) > 255){
            $errors["title"] = "The title must be between [1-255].";
        }
        if(mb_strlen($article) < 20){
            $errors["article"] = "The article must be bigger than 20 chars.";
        }


        if(mb_strlen($artTags) <= 100){
            $arrTags = explode(",", $artTags);
            $tagCnt = 0;
            $hasShortTag = false;
            foreach($arrTags as $row){
                $tag = trim($row);
                if(mb_strlen($tag) == 0){
                    continue;
                }
                if(mb_strlen($tag) > 1){
                    $tagCnt++;
                }else{
                    $errors["tag"] = 'The tag '.$row.' is too short.';
                    $hasShortTag = true;
                    break;
                }
            }
            if($tagCnt == 0 && !$hasShortTag){
                $errors["tag"] = 'Enter at least 1 tag.';
            }
        }else{
            $errors["tag"] = "Too much tags.";
        }

        if(!count($errors)){
            $db -> query('INSERT INTO `posts`(`title`,`text`,`time`,`tags`) VALUES ("'.$db->real_escape_string(htmlspecialchars($artTitle)).'","'.$db->real_escape_string(htmlspecialchars($article)).'","'.time().'","'.$db->real_escape_string(htmlspecialchars($artTags)).'")');
            if(!$db->error){
                echo '<div class="adminSuccess">';
                echo "<p>Post added.</p>";
                echo '</div>';
                unset($arrTags);
                unset($artTitle);
                unset($article);
            }else{
                echo "Database error.<br/>";
            }
        }
    }
?>
    <a href="out.php" class="adminLogout" >Log out</a>
<?php
    if($_POST && count($errors) > 0){
        echo '<div class="adminError">';
        foreach($errors as $err){
            echo '<p>'.$err.'</p>';
        }
        echo '</div>';
    }
?>
    <div class="adminPanel">
        <form action="addPost.php" method="post">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= isset($artTitle) ? $artTitle : '' ?>" placeholder="Title" />
            <label for="article">Article:</label>
            <textarea name="article" cols="30" rows="10" id="article" placeholder="Article"><?= isset($article) ? $article : '' ?></textarea>
            <label for="tags">Tags:</label>
            <input type="text" id="tags" placeholder="Enter tags" value="<?= isset($artTags) ? $artTags : '' ?>" name="tags"/>
            <button type="submit">Post</button>
        </form>
    </div>
<?php
require '../inc/footer.php';