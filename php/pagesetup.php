<?php
function pageHead($t)
{
	$title = 'BOSS | ' . $t;
	$blogvar = '';
	$log = "Login / Register";
	$logbut = '';
	if (isset($_SESSION['uid'])) {
		$_SESSION['lval'] = $_SESSION['uid'] . bin2hex(random_bytes(5));
		$lval = $_SESSION['lval'];
		$logbut = '?w=' . $lval . '';
		$log = "Logout";
		$blogvar = '
				<a href="" class="w3-bar-item w3-mobile w3-hover-pale-yellow">Hi ' . $_SESSION['uid'] . '</a>
				<a href="infopanel.php" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green"> <abbr title="My Profile"> 👥 </abbr> </a>
				<a href="blogpanel.php?w=add" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green"> <abbr title="Add an article"> ➕ </abbr> </a>
				<a href="blogpanel.php?w=view" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green"> <abbr title="Read your articles"> 📖 </abbr> </a>
				';
		if (isset($_SESSION['admin']) and $_SESSION['admin'] == $_SESSION['uid']) {
			$blogvar .= '
			<a href="adminp.php" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green"> <abbr title="Administration Board"> 🏛️ </abbr> </a>
			';
		}
	}
	$pH1 = '💪😎 BOSS: Beautiful Open Source Software! ⚡⚡⚡';
	echo '
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>' . $title . '</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/w3.css" async>
	<link rel="stylesheet" href="css/boss.css" async>
	<link rel="icon" href="images\logo.webp" type="image/x-icon" async>
	<meta name="Description" content="Beautifull Open Source Blogging.">
	</head>

	<body>
	<section style="max-width: 100% !important; padding-bottom: 125px !important; ">
			<div class="w3-top w3-container w3-teal w3-card-4" align=center style="margin-bottom: 500%;">
				<h1 style="display: inline;">' . $pH1 . '</h1>
				<div class="w3-bar w3-green w3-card-4">
					<a href="index.php" class="w3-bar-item w3-btn w3-mobile w3-hover-pale-green"> <abbr title="Home"> 🏠 </abbr> </a>
					<a href="login.php' . $logbut . '" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green"> <abbr title="'.$log.'"> 🚪️ </abbr> </a>
					' . $blogvar . '
				</div>
			</div>
    ';
}
function pageMsg($msg)
{
	echo '
	<div class="w3-container w3-card-4 w3-pale-green w3-margin" style="margin-left: 10%; margin-right: 10%">
		<p>' . $msg . '</p>
	</div>
	';
}
function pageFoot()
{
	$phone = '+91-8237842347';
	$email = 'jaimonalphons@gmail.com';
	$location = 'ABC, XYZ, MH, INDIA, EARTH';
	echo '
    </section>
	<footer class="w3-container w3-teal w3-bottom" >
			<p> Contact us 🤙 <br>
			Phone 📞 ' . $phone . ' <br>
			Email 📧 ' . $email . ' <br>
			Location 🚂 ' . $location . '<br></p>
	</footer>
	</body>
    </html>

    ';
}
function jsalert($msg)
{
	echo '<script> alert(" ' . $msg . ' "); </script>';
}
function jsloc($uri)
{
	echo '<script> window.location.replace("' . $uri . '") </script>';
}
function phploc($uri)
{
	header("location: $uri");
}
