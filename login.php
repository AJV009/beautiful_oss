<?php
include_once 'php/pagesetup.php';
pageHead('Login');
echo '
        <div class="w3-container " style="margin-top:1%">
			<div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:30%; margin-right:30%">
				<h4><br><--- Log in ---></h4>
				(Only if you already have an account)
				<br>
				<form class="w3-container" action = "" method=POST>
 					<h4 class="w3-left w3-margin-left">Username</h4><input class="w3-input w3-border w3-round-xxlarge" type="text" name="username" required>
    				<h4 class="w3-left w3-margin-left">Password</h4><input class="w3-input w3-border w3-round-xxlarge" type="password" name="password" required>
    				<input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="submit" name="checklogin">
 				</form>
 				<h3>OR</h3>
 				<h4><--- Sign up ---></h4>
 				(For a new account)
 				<form class="w3-container" action = "" method=POST>
    				<h4 class="w3-left w3-margin-left">Username</h4><input class="w3-input w3-border w3-round-xxlarge" type="text" name="username" required>
                    <h4 class="w3-left w3-margin-left">E-mail ID</h4><input class="w3-input w3-border w3-round-xxlarge" name="email" required>
    				<h4 class="w3-left w3-margin-left">Password</h4><input class="w3-input w3-border w3-round-xxlarge" type="password" name="password" required>
    				<input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="submit" name="insert">
 				</form>
			</div>
		</div>
        ';
pageFoot(); 
?>