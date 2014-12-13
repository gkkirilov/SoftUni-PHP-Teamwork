<?php
    session_start();

    $admins = array(
        "admin" => "admin",
        "admin2"=> "nopass"
    );

    if($_POST){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        foreach($admins as $user => $pass){
            if($user == $username && $pass == $password){
                $_SESSION['isLogged'] = true;
                Header("Location: addPost.php");
                break;
            }
        }
    }

    $title = "Admin Panel";
    require '../inc/header.php';

    if($_POST && (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === false)){
        echo "Access denied.";
    }
?>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="username"/><br/>
        <input type="password" name="password" placeholder="password" /><br/>
        <input type="submit" value="Submit"/>
    </form>
<?php

require '../inc/footer.php';
