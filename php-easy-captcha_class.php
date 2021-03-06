<?php


/*
The MIT License (MIT)
Copyright (c) 2015 Jan Knipper <j.knipper@part.berlin>
Copyright (c) 2021 CS-Digital UG <info  @cs  -  digital-   ug . ~~ de >
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
SOURCE: https://github.com/dmd2222/php-easy-captcha
   */

class easy_captcha{
  
  
//public functions

static public function make_captcha_html($captcha_static_no_unique_index,$label_text="Please enter captcha:",$my_img_url="",$random_img=false,$my_captcha_text="",$button_text="Captcha solved.",$delete_solution_file_after_solved=true,$recreate_captcha=true,$captcha_wrong_message="Captcha not correct. Please try again..."){
//$captcha_static_no have to be unique for every captcha

	//folder exist
	if (!file_exists('captcha_temp')) {
		mkdir('captcha_temp', 0700, true);
	}

	//start program
	$captcha_no=hash("md5",date("Ynj").$_SERVER['SERVER_NAME'].$_SERVER['REMOTE_ADDR'].$captcha_static_no_unique_index);
	$file_path="captcha_temp/" . $captcha_no . ".csolution"; 
	if(isset($_GET["captcha".$captcha_no])==false){
		captchatry:
		if($my_captcha_text<>""){
				//text setted
				$captcha_solution=$my_captcha_text;
		}else{
				//no text set
				$captcha_solution=rand(10000,99999);
		}
		file_put_contents($file_path, $captcha_solution);
		chmod($captcha_no . ".csolution",0600);

		$set_rand_img="";
		if($random_img == true)
			$set_rand_img="&random_img=1";

		$set_my_img_url="";
		if($my_img_url <>"")
			$set_my_img_url="&iurl=" . $my_img_url;

		if($label_text =="")
			$label_text="Please enter captcha:";
		
		if($button_text =="")
			$button_text="Captcha solved.";

		echo(file_get_contents("https://idenlink.de/api_online/captcha_api/0.1/captcha_api.php?ot=html_only" . $set_rand_img . "&ct=" . $captcha_solution . $set_my_img_url));
		echo "<br>";
		echo' <form action="">
		<label>' . $label_text . '</label>
		<input type="text"  name="' . "captcha".$captcha_no . '"><br><br>
		<input type="submit" value="' . $button_text .'">
	  </form> ';
	}else{
		if($_GET["captcha".$captcha_no]==file_get_contents($file_path)){
			//captcha correct
			//del file
			if($delete_solution_file_after_solved==true){
				unlink($file_path);
			}
			//continue
			return 2;
		}else{
			//wrong captcha

			//recreate captcha
			if($recreate_captcha == true){
				//recreate captcha
				if($captcha_wrong_message =="")
					$captcha_wrong_message="Captcha not correct. Please try again...";
				echo $captcha_wrong_message;
				goto captchatry; // recreate captcha
			}else{
				//no recreation
				return 1;
			}
		}
	}
}



//private functions

//constructor
private function __construct()
{
	//prevent creating object of class.
}
  
}
?>
