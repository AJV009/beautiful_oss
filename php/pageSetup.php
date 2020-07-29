<?php
/*
pageHead($t,$log='Login') - Page Header!
pageFoot() - Page Footer!
jsalert($msg) - create alert
jsloc($loc) - change locations
*/
function pageHead($t) {
	$title = 'BOSS: '.$t;
	$log = 'Login';
	$blogvar = '';
	if(isset($_SESSION['uid'])){
		$log = 'Logout';
		$blogvar = '
				<a href="blogpanel.php?w=add" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green">Add</a>
				<a href="blogpanel.php?w=view" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green">View</a>
		';
	}
    $pH1 = 'Beautiful Open Source Software Blogs!';
    echo '

	<html>
	<head>
	<title>'.$title.'</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/w3.css">
	<link rel="icon" href="images\logo.webp" type="image/x-icon">
	<style> 
		body {
			background-image: url("images/c3.webp"); }
	 </style>
	 </head>

	 <body style="padding-top: 100px;">
	 <STYLE>A {text-decoration: none;} </STYLE>
	 <section>
			<div class="w3-top w3-container w3-teal w3-card-4" align=center style="margin-bottom: 500%;">
				<img style="display: inline; width:13%; height:13%;" class="w3-padding" src="images/logo.webp" alt="logo" />
				<h1 style="display: inline;">'.$pH1.'</h1>
				<div class="w3-bar w3-green w3-card-4">
					<a href="index.php" class="w3-bar-item w3-btn w3-mobile w3-hover-pale-green">Home</a>
					<a href="login.php" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green">'.$log.'</a>
					'.$blogvar.'
				</div>
			</div>
	</section>
    ';
}

function pageMsg($msg){
	echo '
	<div class="w3-container w3-card-4 w3-pale-green w3-margin" style="margin-left: 10%; margin-right: 10%">
		<p>'.$msg.'</p>
	</div>
	';
}
function pageFoot(){
    $phone = '+91-8237842347';
    $email = 'jaimonalphons@gmail.com';
    $location = 'ABC, XYZ, MH, INDIA, EARTH';
    echo '
    
	<footer class="w3-container w3-teal w3-card-4 w3-padding" >
			<p> Contact us - <br>
			Phone - '.$phone.' <br>
			Email - '.$email.' <br>
			Location - '.$location.'<br></p>
	</footer>
	</body>
    </html>

    ';
}
function jsalert($msg){
    echo '<script> alert(" '.$msg.' "); </script>';
}
function jsloc($uri){
    echo '<script> window.location.replace("'.$uri.'"); </script>';
}
?>