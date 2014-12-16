<?php
    require '../inc/struct.php';
    if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true){
        header("Location: addPost.php");
    }
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


    getHeader("Blog | Admin", "../");

    if($_POST && (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === false)){
        echo '<div class="adminError">';
        echo '<p>Access denied.</p>';
        echo '</div>';
    }
?>
  <div class="adminPanel">
      <form action="index.php" method="post">
          <input type="text" name="username" value="<?= isset($username) ? $username : '' ?>" placeholder="username"/>
          <input type="password" name="password" placeholder="password"/>
          <input type="submit" value="Submit"/>
      </form>
  </div>
<?php

getFooter();
