<?php
require "inc/Database.php";
$db = new Database();
$db = $db -> dbConnection;
$title =  "Blog | Home";
$styleFile = "styles/style.css";
$scriptFile = "scripts/script.js";
require "inc/header.php";

$query = $db->query('SELECT * FROM posts ');

    if($query->num_rows()){
        while($row = $query->fetch_assoc()){
            
        }
    }else{
        echo "<p>No posts.</p>";
    }

require "inc/Footer.php";