<?php
require "inc/Database.php";
$db = new Database();
$title =  "Blog | Home";
$styleFile = "styles/style.css";
$scriptFile = "scripts/script.js";
require "inc/header.php";
?>

<?php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo ($actual_link);
?>

<?php
require "inc/Footer.php";
?>