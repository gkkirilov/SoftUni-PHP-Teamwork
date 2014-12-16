<?php
date_default_timezone_set("Europe/Sofia");
mb_internal_encoding("utf-8");
require "utils.php";
require "inc/Database.php";
$db = new Database();
$posts = $db->getMostViewedPosts();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= !isset($styleFile) ? 'styles/style.css' : $styleFile; ?>"/>
    <script src="<?= !isset($scriptFile) ? 'scripts/script.js' : $scriptFile; ?>"></script>
</head>
<body>
<div class="wrapper clear">
    <header>
        <nav>
            <ul>
                <li><a href="<?= getSearchUrl('index.php') ?>">Home</a></li>
                <li><a href="">Posts</a></li>
                <li><a href="<?= getSearchUrl('about.php') ?>">About us</a></li>
                <li><a href="<?= getSearchUrl('contact.php') ?>">Contact</a></li>
            </ul>
        </nav>
        <h1><a href="index.php">Blog</a></h1>
    </header>
    <aside>
        <div class="searchBar">
            <h4 id="search-title">Search by tag</h4>

            <form action="search.php" id="search-field" method="get">
                <label for="search">
                    <input type="text" name="search" id="search" required/>
                </label>
                <input type="submit" id="search-button" value=""/>
            </form>
        </div>
        <div>
            <h4 id="search-title">Most Viewed</h4>
            <ul>
                <?php
                foreach ($posts as $row) {
                    echo '<li><a href="post.php?id=' . $row['id'] . '" title="' . $row['title'] . '">' . substr($row['title'], 0, 50) . '...</a></li>';
                }
                ?>
            </ul>
        </div>
    </aside>
    <main>
