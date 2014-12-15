<?php
require "inc/Database.php";
$db = new Database();
$title =  "Blog | Contact";
$styleFile = "styles/style.css";
$scriptFile = "scripts/script.js";
require "inc/header.php";
?>
    <section id="contact-form">
        <form action="contact.php" method="post">
            <h3 id="title">Contact Us</h3>
            <label for="contact-subject">
                <input type="text" id="contact-subject" name="subject" placeholder="Subject"/>
            </label>
            <label for="contact-address">
                <input type="email" id="contact-address" name="address" placeholder="Email"/>
            </label>
            <label for="question">
                <textarea name="question" id="question"></textarea>
            </label>
            <label for="send">
                <input type="submit" id="send-button" name="send" value="Send"/>
            </label>
        </form>
    </section>

<?php
require "inc/Footer.php";
?>