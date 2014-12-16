<?php

require "inc/struct.php";
getHeader("Blog | Contact");
?>
    <section id="contact-form">
        <form action="contact.php" method="post">
            <h3 class="title">Contact Us</h3>
            <label for="contact-subject">
                <input type="text" id="contact-subject" name="subject" placeholder="Subject"/>
            </label>
            <label for="contact-address">
                <input type="text" id="contact-address" name="address" placeholder="Email"/>
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
    if (isset($_POST['send'])) {
        $subject = trim($_POST['subject']);
        $from = $_POST['address'];
        $question = trim($_POST['question']);

        if (mb_strlen($subject) == 0) {
            echo ('<p class="error">Enter a subject!</p>');
        } elseif (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
            echo ('<p class="error">Invalid email address!</p>');
        } elseif (mb_strlen($question) < 0) {
            echo ('<p class="error">Enter a question!</p>');
        } else {
            $question .= "\n".'The message was sent from: '. $from;
            $question = wordwrap($question, 50, "<br/>\r\n");
            mail('rqe04310@piloq.com', $subject, $question);
            echo ('<p class="success">Your message was sent!</p>');
        }
    }

getFooter();