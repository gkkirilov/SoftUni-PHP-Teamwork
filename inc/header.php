<?php
date_default_timezone_set("Europe/Sofia");
mb_internal_encoding("utf-8");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= $styleFile ?>"/>
    <script src="<?= $scriptFile ?>"></script>
</head>
<body>
    <div class="wrapper">
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="">Posts</a></li>
                    <li><a href="">About us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <h1><a href="index.php">Blog</a></h1>
        </header>
        <aside>
            <ul>
                <li><a href="#">Lorem Ipsum is simply</a></li>
                <li><a href="#">Lorem Ipsum is simply</a></li>
                <li><a href="#">Lorem Ipsum is simply</a></li>
                <li><a href="#">Lorem Ipsum is simply</a></li>
                <li><a href="#">Lorem Ipsum is simply</a></li>
            </ul>
        </aside>
        <main>
