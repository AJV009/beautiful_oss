<?php
	error_reporting(0);
	session_start();
	session_unset();
	session_destroy();
?>
<html>
	<title>LMS-v3.0</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/LMS3/asset/w3.css">
	<style> 
		body {
			background-image: url("/LMS3/asset/home1.jpg"); }
	 </style>
	<body>
		<div class="w3-top">
			<div class="w3-container w3-teal w3-card-4" align=center>
				<h1>Library Management System (LMS v3.0)</h1>
			</div>
			<div class="w3-bar w3-green w3-card-4">
				<a href="/LMS3/home.php" class="w3-bar-item w3-btn w3-mobile w3-hover-pale-green">Home</a>
				<a href="/LMS3/gust/gust.php" class="w3-bar-item w3-btn w3-mobile w3-hover-pale-green">Guest</a>
				<a href="/LMS3/userin.php" class="w3-bar-item w3-btn w3-mobile w3-right w3-hover-pale-green">Login / Sign Up</a>
			</div>
		</div>
		<div class="w3-container w3-card-4" align=center style="margin-top:10%">
			<img src="/LMS3/asset/1.jpg">
		</div>
		<br>
		<div class="w3-container w3-sand w3-card-4">
			<p>Welcome to Library Management System(LMS) 3.0. Developed by Alphons Jaimon (CEO of XeonAJ, TYCM-2019) as internship Project. This is a sofisticated Library Book Management System which eases for both admin and students to have a good control of their books in the library. New in this version is the book provider. Book Providers and admin can send messages and deal about the books in the library with ease.</p>
		</div>
		<div class="w3-panel w3-pale-green w3-card-4">
	 		<h3>Planned Upcoming Features :</h3>
  			<p>Online Media Library, More accurate short message service, More comming soon...</p>
			<p><a href="/LMS3/gust/gust.php" class="w3-btn w3-round-large w3-green w3-border" style="width:10%">Guest Login</a><br> If you just got no time to sign up and folow the procedure then access books like a guest.</p>
			<p><a href="/LMS3/userin.php" class="w3-btn w3-round-large w3-green w3-border" style="width:10%">Student Sign Up</a><br> Login or signup to access books and request for more new books in the library.(we have added a new feature to message between registered users)</p>
			<p><a href="/LMS3/userin.php" class="w3-btn w3-round-large w3-green w3-border" style="width:10%">Provider Sign Up</a><br> Book Providers can also register so that they can market their books on this site. But before signing up as a provider please contact the LMS Admin for a Provider's Secret Key. To contact LMS Admin please refer the Contact us section below.</p>
		</div>
		<div class="w3-container w3-teal w3-card-4">
			<p> Contact us - <br>
			Phone - +91 8237842347 <br>
			Website - xeonaj.ddns.net / xeonaj.wordpress.com <br>
			Email - jaimonalphons@gmail.com <br>
			Location - 4, Sonchafa App., Near Ghonse tution center, Savedi, Ahmednagar<br></p>
		</div>
	</body>
</html>