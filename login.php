<?php
include_once 'php/sessionmanager.php';
// sessionClear();
include_once 'php/pagesetup.php';
if(isset($_SESSION['uid'])) sessionClear();
pageHead('Login');
?>
<section>
        <div class="w3-container " style="margin-top:1%">
			<div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:30%; margin-right:30%">
				<h4><br>👉 Log in </h4>
				(Only if you already have an account)
				<br>
				<form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 					<h4 class="w3-left w3-margin-left">Username</h4><input class="w3-input w3-border w3-round-xxlarge" type="text" name="username" required>
    				<h4 class="w3-left w3-margin-left">Password</h4><input class="w3-input w3-border w3-round-xxlarge" type="password" name="password" required>
    				<input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="submit" name="signin">
 				</form>
 				<h3> OR </h3>
 				<h4>📃 Sign up 🤩</h4>
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
$username = $email = $password = "";
include_once 'php/sqlmanager.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $pass = "$username"."$password";
    if( isset( $_POST['signin'] ) ){
        $requests = exequery('select * from users where username = ?','s',$username);
        $dbrow = mysqli_fetch_array($requests);
        if(password_verify($pass,$dbrow['password'])){
            $_SESSION['uid'] = $username;
            jsalert("Logged in successfully!");
            jsloc("index.php");
        } else { jsalert("Incorrect password/username, please try again!"); jsloc("login.php"); sessionClear();} }
    if( isset( $_POST['signup'] ) ){
        $email = test_input($_POST["email"]);
        $requests = exequery('select * from users where username = ? OR email = ?','ss',$username,$email);
        if (!preg_match("/^[0-9a-zA-Z]+$/",$username)) {
            jsalert("Username: Only letters and numbers allowed"); jsloc("login.php");}
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            jsalert("Email: Invalid email format"); jsloc("login.php"); }
        else if (!preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,50})$/",$password)) {
            jsalert("Password: 1 Lower and Upper case character, 1 number, 1 special character and must be at least 6 characters and at most 50"); jsloc("login.php");}
        else if(mysqli_num_rows($requests)<=0){
            $hashedpassword = password_hash($pass, PASSWORD_ARGON2ID);
            exequery('insert into users (username, email, password) values (?,?,?)','sss',$username,$email,$hashedpassword);
            jsalert("Hi ".$username.", Registration Successful! Now you can login");
            jsloc("login.php"); }
        else {
            jsalert("Username/Email already existing!"); jsloc("login.php");
        }
    }
}
?>