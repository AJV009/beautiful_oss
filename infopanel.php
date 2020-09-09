<?php
error_reporting(0);
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
include_once 'php/sqlmanager.php';
pageHead('Profile');
sessionCheck();
$uid = $_SESSION['uid'];
$requests = exequery('select * from users where username = ?', 's', $uid);
$row = mysqli_fetch_array($requests);
$username = $uid;
$email = $row['email'];
$DONE = $ER = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuser = $_POST["username"];
    $nemail = $_POST["email"];
    $npass = $_POST["password"];
    if (isset($_POST['update'])) {
        if ($uid != $nuser) {
            $requests = exequery('select * from users where username = ?', 's', $nuser);
            if (!preg_match("/^[0-9a-zA-Z]+$/", $nuser)) {
                $ER = "Username: Only letters and numbers allowed";
            } else if (mysqli_num_rows($requests) <= 0) {
                exequery('update users set username=? where username=?', "ss", $nuser, $_SESSION['uid']);
                $_SESSION['uid'] = $username = $nuser;
                $DONE = "Hi " . $_SESSION['uid'] . ", profile updated!";
            } else {
                $ER = "Username/Email already existing!";
            }
        }
        if ($row['email'] != $nemail) {
            $requests = exequery('select * from users where email = ?', 's', $nemail);
            if ( !filter_var($nemail, FILTER_VALIDATE_EMAIL)) {
                $ER = "Email: Invalid email format";
            } else if (mysqli_num_rows($requests) <= 0) {
                exequery('update users set email=? where username=?', "ss", $nemail, $_SESSION['uid']);
                $DONE = "Hi " . $_SESSION['uid'] . ", profile updated!";
                $email = $nemail;
            }
        }
        if ($npass != "NAN") {
            if (!preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,50})$/", $npass)) {
                $ER = "Password: 1 Lower and Upper case character, 1 number, 1 special character and must be at least 6 characters and at most 50";
                $hashedpassword = password_hash($pass, PASSWORD_ARGON2ID);
                exequery('update users set password=? where username=?', "ss", $hashedpassword, $_SESSION['uid']);
                $DONE = "Hi " . $_SESSION['uid'] . ", profile updated!";
            }
        }
    }
}
?>

<section>
    <div class="w3-container " style="margin-top:1%">
        <div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:10%; margin-right:10%">
            <p class="error"><?php echo $DONE; ?></p>
            <h4>Update your profile</h4>
            <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h4 class="nline w3-left w3-margin-left">Username</h4>
                <h6>Only letters and numbers allowed</h6>
                <input class="w3-input w3-border w3-round-xxlarge" type="text" name="username" value="<?php echo $username ?>" required>
                <h4 class="nline w3-left w3-margin-left">E-mail ID</h4>
                <input class="w3-input w3-border w3-round-xxlarge" name="email" value="<?php echo $email ?>" required>
                <h4 class="nline w3-left w3-margin-left">Enter a new password</h4>
                <h6 class="error">Only touch this feild if you want to change your password! Cannot be undone.</h6>
                <h6 class="nline"> 1 Lower and Upper case character, 1 number, 1 special character and at least 6 to 50 characters long</h6>
                <input class="w3-input w3-border w3-round-xxlarge" type="password" name="password" value="NAN">
                <input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="Update 😎" name="update">
                <p class="error">* <?php echo $ER; ?></p>
            </form>
        </div>
    </div>
</section>

<?php
pageFoot();
