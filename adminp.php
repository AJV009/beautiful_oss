<?php
include_once 'php/sessionmanager.php';
include_once 'php/pagesetup.php';
if(!isset($_SESSION['admin'])) phploc("index.php");
pageHead('Admin Home');
pageMsg("Your Super Special Admin Panel! ⚠️⚠️⚠️");
pageMsg("To edit or delete someone's post, you can just navigate to ' 📖 Read your articles' BUT do so with care! ⚠️⚠️⚠️");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userentry = "";
    
}
?>
<section>
    <div class="w3-container ">
        <div class="w3-card-4 w3-round-xxlarge w3-sand w3-center" style="margin-left:10%; margin-right:10%">
            <p class="error"><?php echo $DONE; ?></p>
            <h4>Search profile and edit details as needed</h4>
            <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h4 class="nline w3-left w3-margin-left">Username</h4>
                <h6 class="error">Only provide first words of the username you are trying to hunt</h6>
                <input class="w3-input w3-border w3-round-xxlarge" type="text" name="username" required>
                <input class="w3-btn w3-green w3-round-xxlarge w3-margin" type="submit" value="Search 😎" name="search">
                <p class="error">* <?php echo $ER; ?></p>
            </form>
            <div><?php echo $userentry ?></div>    
        </div>
    </div>
</section>
<?php
// TODO: Update, Delete, Switch Right
// TODO: Remove reduntant code, modularize it, make it more small
// TODO: Rewrite css from scratch, move local css modification into a different file
pageFoot();
