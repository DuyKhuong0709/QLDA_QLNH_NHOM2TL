<?php

session_start();
create_image();

function create_image()
{
    
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha = substr(str_shuffle($chars), 0, 4);

    $_SESSION['captcha'] = $captcha;

    $width = 100;
    $height = 50;
    
    $image = ImageCreate($width,$height);

    
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    $green = imagecolorallocate($image, 0, 255, 0);
    $brown = imagecolorallocate($image, 139, 69, 19);
    $orange = imagecolorallocate($image, 255, 69, 0);
    $grey = imagecolorallocate($image, 204, 204, 204);

    
    imagefill($image, 0, 0, $white);

    $font= "./css/RubikSprayPaint-Regular.ttf";
    imagettftext($image, 20, 10, 10, 40, $black, $font, $captcha);

    header("Content-Type: image/png");

    imagepng($image);
   
    imagedestroy($image);
}
?>