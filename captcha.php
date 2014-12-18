<?php
session_start();
$captcha =  substr(str_shuffle("qwertyuiopasdfghjklzxcvbnm1234567890"),-6);
$code = password_hash($captcha, PASSWORD_BCRYPT, array("cost" => 5));
$_SESSION['captcha'] = $code;
$width = 90;
$height = 35;
$image = imagecreate($width,$height);
$background = imagecolorallocate($image,211,211,211);
$foreground = imagecolorallocate($image,0,0,0);
imagestring($image,20,15,10, $captcha, $foreground);
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>