<?php
require "inc/Database.php";
$db = new Database();

$tagSearch = $_GET['search'];

header("location:index.php?tag=".htmlentities($tagSearch));

