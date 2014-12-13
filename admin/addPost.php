<?php
session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] ===  false){
    header("Location: index.php");
}
$title = "Add Post";
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
            $errors["article"] = "The article must be bigger then 20 chars.";
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
                echo "Post added.";
            }else{
                echo "Database error.<br/>";
            }
        }else{
            foreach($errors as $err){
                echo $err."<br/>";
            }
        }
    }
    echo '<a href="out.php" >Log out</a><br/>';

?>
    <form action="addPost.php" method="post">
        <label for="title">Title</label><br/>
        <input type="text" name="title" id="title" placeholder="Title" /><br/>
        <label for="article">Article</label><br/>
        <textarea name="article" cols="30" rows="10" id="article" placeholder="Article"></textarea><br/>
        <label for="tags">Tags</label><br/>
        <input type="text" id="tags" placeholder="Enter tags" name="tags"/><br/>
        <button type="submit">Post</button>
    </form>
<?php
require '../inc/footer.php';