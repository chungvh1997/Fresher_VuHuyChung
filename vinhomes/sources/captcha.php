<?php
session_start();
$ext = isset($_REQUEST['ext']) ? $_REQUEST['ext'] : '';
$ranStr = md5(microtime());
$ranStr = array(substr($ranStr, 0, 3), substr($ranStr, 3, 3));
$_SESSION['captcha_'.$ext] = md5(implode("", $ranStr));
$newImage = imagecreatefromjpeg("../assets/img/captcha.jpg");
$txtColor = imagecolorallocate($newImage, 0, 0, 0);
$height = 80;
$result = imagettftext($newImage, $height, 0, 20, $height+20, $txtColor, "../assets/fonts/tahoma.ttf", implode(" ", $ranStr));
// $newImage = imagecrop($newImage, array( 'x' => 0, 'y' => 0, 'width' => intval($result[2]+30), 'height' => ($height+40) ));
header("Content-type: image/jpeg");
imagejpeg($newImage, "../assets/img/capt_img/captcha_".$ext.".jpg");
imagejpeg($newImage);
?>