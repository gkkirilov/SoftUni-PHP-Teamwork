<?php
require '../inc/struct.php';
$id = (int)$_GET['id'];
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === false || $id <= 0) {
    header("Location: index.php");
}
$title = "Edit Post";

if ($_POST) {
    $artTitle = trim($_POST['title']);
    $article = trim($_POST['article']);
    $artTags = trim($_POST['tags']);
    $errors = array();

    if (isset($_POST['remove'])) {
        $db->deletePost($id);
        header("Location: index.php");
        return;
    }

    if (mb_strlen($artTitle) <= 1 || mb_strlen($artTitle) > 255) {
        $errors["title"] = "The title must be between [1-255].";
    }
    if (mb_strlen($article) < 20) {
        $errors["article"] = "The article must be bigger than 20 chars.";
    }


    if (mb_strlen($artTags) <= 255) {
        $arrTags = explode(",", $artTags);
        $tagCnt = 0;
        $hasShortTag = false;
        foreach ($arrTags as $row) {
            $tag = trim($row);
            if (mb_strlen($tag) == 0) {
                continue;
            }
            if (mb_strlen($tag) > 1) {
                $tagCnt++;
            } else {
                $errors["tag"] = 'The tag ' . $row . ' is too short.';
                $hasShortTag = true;
                break;
            }
        }
        if ($tagCnt == 0 && !$hasShortTag) {
            $errors["tag"] = 'Enter at least 1 tag.';
        }
    } else {
        $errors["tag"] = "Too much tags.";
    }

    if (!count($errors)) {
        $db->updatePostById($id, $artTitle, $article, $artTags);
        if (!$db->dbConnection->error) {
            Header('Location: ../post.php?id=' . $id);
            unset($artTags);
            unset($artTitle);
            unset($article);
        } else {
            $errors[] = "Database error.<br/>";
        }
    }
}

getHeader($title, "../");
$post = $db->getPostById($id);
?>
    <a class="myButton logoutButton" href="out.php" class="adminLogout">Log out</a>
<?php
if ($_POST && count($errors) > 0) {
    echo '<div class="adminError">';
    foreach ($errors as $err) {
        echo '<p>' . $err . '</p>';
    }
    echo '</div>';
}
?>
    <div class="adminPanel">
        <form action="" method="post">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= isset($artTitle) ? $artTitle : $post['title'] ?>"
                   placeholder="Title"/>
            <label for="article">Article:</label>
            <textarea name="article" cols="30" rows="10" id="article"
                      placeholder="Article"><?= isset($article) ? $article : $post['text'] ?></textarea>
            <label for="tags">Tags:</label>
            <input type="text" id="tags" placeholder="Enter tags"
                   value="<?= isset($artTags) ? $artTags : $post['tags'] ?>"
                   name="tags"/>

            <div class="wrapper-buttons">
                <button class="myButton" name="edit" type="submit">Edit</button>
                <button class="myButton" name="remove" type="submit">Remove</button>
            </div>
        </form>
    </div>
<?php
getFooter();