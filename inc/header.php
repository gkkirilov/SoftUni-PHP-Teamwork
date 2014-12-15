<?php
date_default_timezone_set("Europe/Sofia");
mb_internal_encoding("utf-8");
require "utils.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= !isset($styleFile) ? 'styles/style.css' : $styleFile;  ?>"/>
    <script src="<?= !isset($scriptFile) ? 'scripts/script.js' : $scriptFile; ?>"></script>
</head>
<body>
    <div class="wrapper clear">
        <header>
            <nav>
                <ul>
                    <li><a href="<?= getSearchUrl('index.php') ?>">Home</a></li>
                    <li><a href="">Posts</a></li>
                    <li><a href="">About us</a></li>
                    <li><a href="<?= getSearchUrl('contact.php')?>">Contact</a></li>
                </ul>
            </nav>
            <h1><a href="index.php">Blog</a></h1>
        </header>
        <aside>
            <div class="searchBar">
                <h4 id="search-title">Search by tag</h4>
                <form action="search.php" id="search-field" method="get">
                    <label for="search">
                        <input type="text" name="search" id="search"/>
                    </label>
                    <input type="submit" id="search-button" value=""/>
                </form>
            </div>
            <div>
                <ul>
                    <li><a href="#">Lorem Ipsum is simply</a></li>
                    <li><a href="#">Lorem Ipsum is simply</a></li>
                    <li><a href="#">Lorem Ipsum is simply</a></li>
                    <li><a href="#">Lorem Ipsum is simply</a></li>
                    <li><a href="#">Lorem Ipsum is simply</a></li>
                </ul>
            </div>
        </aside>
        <main>
