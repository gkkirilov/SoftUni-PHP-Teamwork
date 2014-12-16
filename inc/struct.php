<?php
session_start();
date_default_timezone_set("Europe/Sofia");
mb_internal_encoding("utf-8");
require "utils.php";
require "Database.php";
$db = new Database();
$posts = $db->getMostViewedPosts();

function getHeader($title, $styleFile = null, $scriptFile = null)
{
    $db = new Database();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="<?= $styleFile == null ? 'styles/style.css' : $styleFile; ?>"/>
        <script src="<?= $scriptFile == null ? 'scripts/script.js' : $scriptFile; ?>"></script>
    </head>
    <body>
    <div class="wrapper clear">
    <header>
        <nav>
            <ul>
                <li><a href="<?= getSearchUrl('home.php') ?>">Home</a></li>
                <li><a href="<?= getSearchUrl('posts.php') ?>">Posts</a></li>
                <li><a href="<?= getSearchUrl('about.php') ?>">About us</a></li>
                <li><a href="<?= getSearchUrl('contact.php') ?>">Contact</a></li>
            </ul>
        </nav>
        <h1><a href="home.php">Blog</a></h1>
    </header>
    <aside>
        <div class="searchBar">
            <h4 id="search-title">Search by tag</h4>

            <form action="index.php" id="search-field" method="get">
                <label for="search">
                    <input type="text" name="tag" value="<?= isset($_GET['tag']) ? $_GET['tag'] : '' ?>" id="search"
                           required/>
                </label>
                <input type="submit" id="search-button" value=""/>
            </form>
        </div>
        <div>
            <h4 id="search-title">Most Popular Tags</h4>
            <ul>
                <?php
                $tags = array_keys($db->getMostPopularTags());
                foreach ($tags as $tag)
                    echo "<li><a href='" . getSearchUrl("index.php?tag=" . $tag) . "'>#$tag</a></li>";
                ?>
            </ul>
        </div>
        <div>
            <h4 id="search-title">Most Viewed</h4>
            <ul>
                <?php
                $posts = $db->getMostViewedPosts();
                foreach ($posts as $row) {
                    echo '<li><a href="post.php?id=' . $row['id'] . '" title="' . $row['title'] . '">' . mb_substr($row['title'], 0, 50) . '...</a></li>';
                }
                ?>
            </ul>
        </div>
        <div>
            <h4 id="search-title">Most Recent</h4>
            <ul>
                <?php
                $posts = $db->getAllPosts(0, 5);
                foreach ($posts as $row) {
                    echo '<li><a href="post.php?id=' . $row['id'] . '" title="' . $row['title'] . '">' . mb_substr($row['title'], 0, 50) . '...</a></li>';
                }
                ?>
            </ul>
        </div>
    </aside>
    <main><?php
}

function getFooter()
{
    ?>

    </main>
    </div>
    <footer>

    </footer>
    </body>
    </html>
<?php
}