<?php
head($title){
    echo '
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
		</div>';
}
?>