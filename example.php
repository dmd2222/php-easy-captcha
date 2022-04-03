<?php

 
switch (make_captcha_html("0002","Sei so nett und schreib mal ab, was hier in dem Bild steht...","https://idenlink.de/api_online/captcha_api/picture.png",false,rand(10000,99999),"Ich habe fertig...",false,false,"Du hattest nur eine Aufgabe... eine einzige. Enen weiteren versuch hast du nicht...")) {
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
