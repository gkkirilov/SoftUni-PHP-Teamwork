<?php
session_start();
date_default_timezone_set("Europe/Sofia");
mb_internal_encoding("utf-8");
require "utils.php";
require "Database.php";
$db = new Database();
$posts = $db->getMostViewedPosts();

function getHeader($title, $path = "")
{
    $db = new Database();
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="<?= $path ?>styles/style.css"/>
        <script src="<?= $path ?>scripts/script.js"></script>
        <script src="<?= $path ?>scripts/jquery-1.7.2.min.js"></script>
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
                <?php
                if (isLogged()) {
                    $url = 'admin/index.php';
                    echo '<li><a href="'.$url.'">Add Post</a></li>';
                }
                ?>
            </ul>
        </nav>
        <h1><a title='TEAM BERLIN BLOG' href="<?= getSearchUrl('home.php') ?>">Blog</a></h1>
    </header>
    <aside>
        <div class="searchBar">
            <h4 id="search-title">Search by tag</h4>

            <form action="posts.php" id="search-field" method="get">
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
                if(count($tags) > 0){
                    foreach ($tags as $tag) {
                        $mostPopularTag = mb_strlen($tag) > 16 ? mb_substr($tag, 0, 16) . "..." : $tag;
                        echo "<li><a href='" . getSearchUrl("posts.php?tag=" . $tag) . "'>#$mostPopularTag</a></li>";
                    }
                }else{
                    echo "<p class='text'>No tags.</p>";
                }
                ?>
            </ul>
        </div>
        <div>
            <h4 id="search-title">Most Viewed</h4>
            <ul>
                <?php
                $posts = $db->getMostViewedPosts();
                if(count($posts) > 0){
					foreach ($posts as $row) {
                        $mostViewedTitle = mb_strlen($row['title']) > 15 ? mb_substr($row['title'], 0, 16) . "..." : $row['title'];
                        echo '<li><a href="' . getSearchUrl("post.php?id=" . $row['id']) . '" title="' . $row['title'] . '">' . $mostViewedTitle . '</a></li>';
					}
				}else{
                    echo "<p class='text'>No posts.</p>";
                }
                ?>
            </ul>
        </div>
        <div>
            <h4 id="search-title">Most Recent</h4>
            <ul>
                <?php
                $posts = $db->getAllPosts(0, 5);
                if(count($posts) > 0){
					foreach ($posts as $row) {
						$mostRecentTitle = mb_strlen($row['title']) > 16 ? mb_substr($row['title'], 0, 16) . "..." : $row['title'];
						echo '<li><a href="' . getSearchUrl("post.php?id=" . $row['id']) . '" title="' . $row['title'] . '">' . $mostRecentTitle . '</a></li>';
					}
				}else{
					echo "<p class='text'>No posts.</p>";
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
        <div id="footerNav">
            <article id="navigation">
                <nav>
                    <ul>
                        <li><a href="<?= getSearchUrl('home.php') ?>">Home</a></li>
                        <li><a href="<?= getSearchUrl('posts.php') ?>">Posts</a></li>
                        <li><a href="<?= getSearchUrl('about.php') ?>">About us</a></li>
                        <li><a href="<?= getSearchUrl('contact.php') ?>">Contact</a></li>
                    </ul>
                </nav>
            </article>
            <article id="facebook">
                <iframe
                    src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FSoftwareUniversity%3Ffref%3Dts&amp;width=300&amp;height=68&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true"
                    scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:68px;"
                    allowTransparency="true">
                </iframe>
            </article>
            <article id="copyRight">
                <span>&#0169; 2014-2015 - Blog. All Rights Reserved.</span>
            </article>
        </div>
    </footer>
    </body>
    </html>
<?php
}