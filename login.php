<?php
include_once 'php/pagesetup.php';
pageHead('Login');
$username = $email = $password = "";
?>
<section>
        <div class="w3-container " style="margin-top:1%">
			<div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:30%; margin-right:30%">
				<h4><br><--- Log in ---></h4>
				(Only if you already have an account)
				<br>
				<form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 					<h4 class="w3-left w3-margin-left">Username</h4><input class="w3-input w3-border w3-round-xxlarge" type="text" name="username" required>
    				<h4 class="w3-left w3-margin-left">Password</h4><input class="w3-input w3-border w3-round-xxlarge" type="password" name="password" required>
    				<input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="submit" name="signin">
 				</form>
 				<h3>OR</h3>
 				<h4><--- Sign up ---></h4>
 				(For a new account)<br>
 				<form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <h4 style="display: inline;" class="w3-left w3-margin-left">Username</h4><h6 >Only letters and numbers allowed</h6>
                        <input class="w3-input w3-border w3-round-xxlarge" type="text" name="username" required>
                    <h4 class="w3-left w3-margin-left">E-mail ID</h4>
                        <input class="w3-input w3-border w3-round-xxlarge" name="email" required>
                    <h4 style="display: inline;" class="w3-left w3-margin-left">Password</h4><h6 >1 Lower and Upper case character, 1 number, 1 special character and at least 6 to 50 characters long</h6>
                        <input class="w3-input w3-border w3-round-xxlarge" type="password" name="password" required>
    				<input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="submit" name="signup">
 				</form>
			</div>
        </div>
</section>
<?php
pageFoot();
// LOGIN/SIGNUP LOGIC BOARD 😂😂😂
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$mysqli = new mysqli("localhost","root","","boss");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if( isset( $_POST['signin'] ) ){
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);
        $query = 'select * from users where username = "'.$username.'"';
        $requests = $mysqli -> query($query);
        if(password_verify($password,$requests['password'])){
            jsalert("Logged in successfully!");
            jsloc("index.php");
        } else { jsalert("Incorrect password/username, please try again!"); jsloc("index.php"); } }
    if( isset( $_POST['signup'] ) ){
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $query = 'select * from users where username = "'.$username.'" OR email = "'.$email.'"';
        $requests = $mysqli -> query($query);
        if (!preg_match("/^[0-9a-zA-Z]+$/",$username)) {
            jsalert("Username: Only letters and numbers allowed"); jsloc("login.php"); }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            jsalert("Email: Invalid email format"); jsloc("login.php"); }
        else if (!preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,50})$/",$password)) {
            jsalert("Password: 1 Lower and Upper case character, 1 number, 1 special character and must be at least 6 characters and at most 50"); jsloc("login.php"); }
        else if(mysqli_num_rows($requests)<=0){
            $hashedpassword = password_hash($password, PASSWORD_ARGON2ID);
            $query = 'insert into users (username, email, password) values ("'.$username.'","'.$email.'","'.$hashedpassword.'")'; 
            $mysqli -> query($query);
            jsalert("Hi ".$username.", Registration Successful! Now you can login");
            jsloc("login.php"); }
        else {
            jsalert("Username/Email already existing!"); jsloc("login.php");
        }
    }
}
?>