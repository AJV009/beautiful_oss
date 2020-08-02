<?php
function pageHead($t) {
	error_reporting(0);
	$title = 'BOSS: '.$t;
	$log = 'Login';
	$blogvar = '';
	if(isset($_SESSION['uid'])){
		$log = 'Logout';
		$blogvar = '
				<a href="blogpanel.php?w=add" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green">➕ Add new Posts!</a>
				<a href="blogpanel.php?w=view" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green">📖 View My Posts</a>
		';
	}
    $pH1 = '💪😎 BOSS: Beautiful Open Source Software! ⚡⚡⚡';
	echo '
	<style> 
	.error {color: #FF0000;} 
	.success {color: #00F2FF;} 
	.msg {color: #FF0000;} 
	</style>
	<html>
	<head>
	<title>'.$title.'</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/w3.css">
	<link rel="icon" href="images\logo.webp" type="image/x-icon">
	<style> body { background-image: url("images/c3.webp"); } </style>
	 </head>

	 <body style="padding-top: 100px;">
	 <STYLE>A {text-decoration: none;} </STYLE>
	 <section>
			<div class="w3-top w3-container w3-teal w3-card-4" align=center style="margin-bottom: 500%;">
				<h1 style="display: inline;">'.$pH1.'</h1>
				<div class="w3-bar w3-green w3-card-4">
					<a href="index.php" class="w3-bar-item w3-btn w3-mobile w3-hover-pale-green">🏠 Home</a>
					<a href="login.php" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green">👥 '.$log.'</a>
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
			<p> Contact us 🤙 <br>
			Phone 📞 '.$phone.' <br>
			Email 📧 '.$email.' <br>
			Location 🚂 '.$location.'<br></p>
	</footer>
	</body>
    </html>

    ';
}
function jsalert($msg){ echo '<script> alert(" '.$msg.' "); </script>'; }
function jsloc($uri){ echo '<script> window.location.replace("'.$uri.'") </script>'; }
function phploc($uri){ header("location: $uri"); }