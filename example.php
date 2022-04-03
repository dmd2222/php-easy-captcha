<?php
require_once("php-easy-captcha_class.php");
 
switch (easy_captcha::make_captcha_html("0001","Write this text...","https://idenlink.de/api_online/captcha_api/picture.png",false,rand(10000,99999),"done...",false,true,"error or so...")) {
    case 2:
        //captcha correct
		echo"Captcha correct.";
        break;
    case 1:
		//captcha wrong
		echo"Captcha not correct. Please try again...";
        break;
    default:
		//captcha not entered yet
		echo"Have you seen the captcha?...";
        break;
}



?>
