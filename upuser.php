<?php
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
if (!isset($_SESSION['admin'])) phploc("index.php");
pageHead('Power panel');
if (isset($_GET['id'])) {
    $_SESSION['gid'] = $_GET['id'];
} else if (!isset($_SESSION['gid'])) {
    phploc("index.php");
}
$gid = $_SESSION['gid'];
$requests = exequery('select * from users where id = ?', 's', $gid);
$existing = mysqli_fetch_array($requests);
$username = $existing['username'];
$email = $existing['email'];
if($existing['type'] == 'admin') $acc = "user";
else $acc = "admin";
$DONE = $ER = $ERD = $ERP = $ERA = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $nuser = $_POST["username"];
        $nemail = $_POST["email"];
        if ($existing['username'] != $nuser) {
            $requests = exequery('select * from users where username = ?', 's', $nuser);
            if (!preg_match("/^[0-9a-zA-Z]+$/", $nuser)) {
                $ER = "Username: Only letters and numbers allowed";
            } else if (mysqli_num_rows($requests) <= 0) {
                exequery('update users set username=? where username=?', "ss", $nuser, $existing['username']);
                $DONE = "Hi " . $_SESSION['uid'] . ", profile updated!";
            } else {
                $ER = "Username/Email already existing!";
            }
        }
        if ($existing['email'] != $nemail) {
            $requests = exequery('select * from users where email = ?', 's', $nemail);
            if (!filter_var($nemail, FILTER_VALIDATE_EMAIL)) {
                $ER = "Email: Invalid email format";
            } else if (mysqli_num_rows($requests) <= 0) {
                exequery('update users set email=? where username=?', "ss", $nemail, $existing['username']);
                $DONE = "Hi " . $_SESSION['uid'] . ", profile updated!";
                $email = $nemail;
            } else {
                $ER = "Username/Email already existing!";
            }
        }
    }
    if (isset($_POST['updatepass'])) {
        $npass = $_POST["npassword"];
        $rnpass = $_POST["rnpassword"];
        if ($rnpass == $npass) {
            if (preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,50})$/", $npass)) {
                $rnpass = $existing['username'] . "$rnpass";
                $hashedpassword = password_hash($rnpass, PASSWORD_ARGON2ID);
                exequery('update users set password=? where username=?', "ss", $hashedpassword, $existing['username']);
                $DONE = "Hi " . $_SESSION['uid'] . ", profile updated!";
            } else $ERP = "Password: 1 Lower and Upper case character, 1 number, 1 special character and must be at least 6 characters and at most 50";
        } else $ERP = "New password in both feilds are not equal/same!";
    }
    if (isset($_POST['delete'])) exequery('delete from users where username=?', 's', $uid);
    if (isset($_POST['switch'])) {
        if($acc == "admin") { 
            exequery('update users set type=? where username=?', "ss", "admin", $existing['username']);
            $acc = "user";
        } 
        else {
            exequery('update users set type=? where username=?', "ss", "user", $existing['username']);
            $acc = "admin";
        } 
        $DONE = "User access switched";
    }
}
?>
<section>
    <div class="w3-container ">
        <div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:10%; margin-right:10%">
            <p class="error"><?php echo $DONE; ?></p>
            <h4>Update your profile</h4>
            <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h4 class="nline w3-left w3-margin-left">Username</h4>
                <h6>Only letters and numbers allowed</h6>
                <input class="w3-input w3-border w3-round-xxlarge" type="text" name="username" value="<?php echo $username ?>" required>
                <h4 class="nline w3-left w3-margin-left">E-mail ID</h4>
                <input class="w3-input w3-border w3-round-xxlarge" name="email" value="<?php echo $email ?>" required>
                <input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="Update 😎" name="update">
                <p class="error">* <?php echo $ER; ?></p>
            </form>
        </div>
    </div>
    <div class="w3-container">
        <div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:10%; margin-right:10%">
            <h4>Change Password</h4>
            <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h4 class="nline w3-left w3-margin-left">Enter new password</h4>
                <h6 class="error">Only touch these feilds if you want to change your password! Cannot be undone.</h6>
                <h6 class="nline"> 1 Lower and Upper case character, 1 number, 1 special character and at least 6 to 50 characters long</h6>
                <input class="w3-input w3-border w3-round-xxlarge" type="password" name="npassword">
                <h4 class="w3-left w3-margin-left">Re type new password</h4>
                <input class="w3-input w3-border w3-round-xxlarge" type="password" name="rnpassword">
                <input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="Update" name="updatepass">
                <p class="error">* <?php echo $ERP; ?></p>
            </form>
        </div>
    </div>
    <div class="w3-container">
        <div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:10%; margin-right:10%">
            <h4>Delete Account</h4>
            <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h6 class="error">Click with care, once deleted cannot be UNDONE. All the articles will remain even after deletion of the account.</h6>
                <input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="Delete" name="delete">
                <p class="error">* <?php echo $ERD; ?></p>
            </form>
        </div>
    </div>
    <div class="w3-container">
        <div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:10%; margin-right:10%">
            <h4>Switch Account Access</h4>
            <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="Make <?php echo $acc ?>" name="switch">
                <p class="error">* <?php echo $ERA; ?></p>
            </form>
        </div>
    </div>
    <section>
        <?php
        pageFoot();
